<?php

namespace App\Http\Controllers;

use App\Models\Admin\Account_Types;
use App\Models\Admin\Customer;
use App\Models\Admin\Product;
use App\Models\Admin\Sale;
use App\Models\Admin\SaleProduct;
use App\Models\Admin\Transactions;
use App\Models\ProductRecipe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    /**
     * Display POS sale prototype.
     */
    public function index()
    {
        $store_id = auth()->user()->store_id; // or get store ID as per your logic
        $accounts = DB::table('account_types')->where(['is_money' => 1, 'store_id' => $store_id])->get();
        $results = DB::table('product_stocks as ps')
            ->select('ps.*', 'p.product_title', 'u.unit_name')
            ->join('products as p', 'ps.product_id', '=', 'p.id')
            ->join('units as u', 'p.unit_id', '=', 'u.id')
            ->where('ps.store_id', $store_id)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('p.category_id', 2); // allow any quantity
                })
                    ->orWhere(function ($q) {
                        $q->where('p.category_id', 1)
                            ->where('ps.quantity', '>', 0); // only if quantity > 0
                    });
            })
            ->get();


        return view('dashboard.admin.productManagement.pos_prototype', compact('results', 'accounts'));
    }


    public function searchPhone(Request $request)
    {
        $q = $request->query('q');
        $customers = DB::table('customers')
            ->where('customer_phone', 'like', "%{$q}%")
            ->limit(10)
            ->get(['customer_phone', 'customer_name']);

        return response()->json($customers);
    }

    public function searchProduct(Request $request)
    {
        $store_id = auth()->user()->store_id; // adjust if needed
        $query = $request->q;


        $results = DB::table('product_stocks as ps')
            ->select('ps.id', 'p.product_title', 'ps.sell_price')
            ->join('products as p', 'ps.product_id', '=', 'p.id')
            ->where('ps.store_id', $store_id)
            ->where('p.product_title', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();

        return response()->json($results);
    }

    public function newSave(Request $request)
    {
        $store_id = \Auth::guard('admin')->user()->store_id;
        $cartItems = json_decode($request->cart_items, true);

        if (empty($cartItems)) {
            return response()->json(['code' => 0, 'msg' => 'Cart is empty!']);
        }

        $saleDate = $request->sale_date == date('Y-m-d')
            ? now()
            : Carbon::parse($request->sale_date . ' ' . now()->format('H:i:s'));

        $discount = floatval($request->discount) ?: 0;
        $paid = floatval($request->paid) ?: 0;

        $result = $this->getOrCreateParentId(
            $request->customer_phone,
            $request->customer_name,
            $request->customer_email,
            $store_id
        );
        $accbyPaid = $request->payment_method;

        $allaccount = DB::table('account_types')
            ->select('id', 'account_head_id', 'account_name', 'is_money', 'code')
            ->where(['store_id' => $store_id, 'acctype_status' => 1])
            ->get();

        $sales_revenue = $allaccount->where('account_name', 'Sales Revenue')->pluck('code')->first();
        $discount_allowed = $allaccount->where('account_name', 'Discount Allowed')->pluck('code')->first();
        $is_wallet = $allaccount->where('code', $accbyPaid)->first();
        $bank_cheque = $allaccount->where('account_name', 'Bank Cheque')->pluck('code')->first();

        $invtotal = DB::table('sales')->where(['store_id' => $store_id])->get();
        $invoice_no = 'SI-' . $saleDate->format('ymd') . '-' . (count($invtotal) + 1);

        $customerId = $result['parent_id'];
        $chequeDetail = $request->cheque_detail ?? '';
        $acc_code = $accbyPaid;
        if ($accbyPaid == $bank_cheque) {
            $acc_code = $customerId;
            $paid = 0;
            $due = $request->total - $discount;
            $check_pending = 1;
            $description = $chequeDetail;
        }

        if ($is_wallet) {
            $description = 'Paid through' . $is_wallet->account_name;
        }

        $total = collect($cartItems)->sum(fn($item) => $item['qty'] * $item['price']);
        $due = $total - $paid - $discount;

        DB::beginTransaction();

        try {

            // === Insert Sale ===
            $sale = Sale::create([
                'customer_id' => $customerId,
                'invoice_no' => $invoice_no,
                'total' => $total,
                'discount' => $discount,
                'paid' => $paid,
                'due' => $due,
                'sale_status' => 1,
                'store_id' => $store_id,
                'trns_type' => Account_Types::where('code', $accbyPaid)->value('account_name') ?? 'Cash',
                'description' => $chequeDetail,
                'check_pending' => ($chequeDetail != '') ? 1 : 0,
                'created_at' => $saleDate
            ]);

            // === Insert Sale Products & Update Stock ===
            foreach ($cartItems as $item) {
                $product = Product::where('product_title', $item['name'])->first();
                if (!$product) continue;

                SaleProduct::create([
                    'sale_hash_id' => md5(uniqid(rand(), true)),
                    'customer_id' => $customerId,
                    'product_id' => $product->id,
                    'pdtstock_id' => $item['stock_id'] ?? null,
                    'invoice_no' => $invoice_no,
                    'quantity' => $item['qty'],
                    'rate' => $item['price'],
                    'sale_by' => auth('admin')->id(),
                    'store_id' => $store_id,
                    'created_at' => $saleDate
                ]);

                // Deduct stock
                if ($product->category_id == 1) {
                    DB::table('product_stocks')
                        ->where('id', $item['stock_id'])
                        ->where('store_id', $store_id)
                        ->decrement('quantity', $item['qty']);
                } elseif ($product->category_id == 2) {
                    $recipes = ProductRecipe::where('product_id', $product->id)->get();
                    foreach ($recipes as $recipe) {
                        $rawProductId = $recipe->raw_product_id;
                        $requiredQty = $recipe->quantity * $item['qty'];

                        $stockBatches = DB::table('product_stocks')
                            ->where('product_id', $rawProductId)
                            ->where('store_id', $store_id)
                            ->where('quantity', '>', 0)
                            ->orderBy('purchase_date', 'asc')
                            ->get();

                        foreach ($stockBatches as $batch) {
                            if ($requiredQty <= 0) break;

                            if ($batch->quantity >= $requiredQty) {
                                DB::table('product_stocks')
                                    ->where('id', $batch->id)
                                    ->decrement('quantity', $requiredQty);

                                DB::table('stock_movements')->insert([
                                    'product_id' => $rawProductId,
                                    'batch_no' => $batch->batch_no,
                                    'quantity_deducted' => $requiredQty,
                                    'reason' => 'sale for product #' . $product->id,
                                    'store_id' => $store_id,
                                    'created_at' => $saleDate,
                                ]);

                                $requiredQty = 0;
                            } else {
                                DB::table('product_stocks')
                                    ->where('id', $batch->id)
                                    ->update(['quantity' => 0]);

                                DB::table('stock_movements')->insert([
                                    'product_id' => $rawProductId,
                                    'batch_no' => $batch->batch_no,
                                    'quantity_deducted' => $batch->quantity,
                                    'reason' => 'sale for product #' . $product->id,
                                    'store_id' => $store_id,
                                    'created_at' => $saleDate,
                                ]);

                                $requiredQty -= $batch->quantity;
                            }
                        }
                    }
                }
            }

            $save_data = [];

            // Cash Sale (Paid in full)
            if ($total == $paid) {
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $acc_code,
                    'description' => 'Cash Sale',
                    'amount' => $paid,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $sales_revenue,
                    'description' => 'Cash Sale',
                    'amount' => $paid,
                    'direction' => -1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                Transactions::insert($save_data);
            }

            // Cash Sale with Discount
            if (($discount > 0) and $due == 0 and ($paid + $discount == $total)) {
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $acc_code,
                    'description' => 'Cash Sale with Discount',
                    'amount' => $paid,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $discount_allowed,
                    'description' => 'Cash Sale with Discount',
                    'amount' => $discount,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $sales_revenue,
                    'description' => 'Cash Sale with Discount',
                    'amount' => $total,
                    'direction' => -1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                Transactions::insert($save_data);
            }

            // Credit Sale (Due == Total)
            if (($due == $total)) {
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $customerId,
                    'description' => 'Credit Sale',
                    'amount' => $total,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $sales_revenue,
                    'description' => 'Credit Sale',
                    'amount' => $due,
                    'direction' => -1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                Transactions::insert($save_data);
            }

            // Credit Sale with Discount
            if ($discount > 0 and $due > 0 and ($due + $discount == $total)) {
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $customerId,
                    'description' => 'Credit Sale with Discount',
                    'amount' => $due,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $discount_allowed,
                    'description' => 'Credit Sale with Discount',
                    'amount' => $discount,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $sales_revenue,
                    'description' => 'Credit Sale with Discount',
                    'amount' => $total,
                    'direction' => -1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                Transactions::insert($save_data);
            }

            // Partial Paid + Discount + Due
            if (($due > 0) and ($discount > 0) and ($paid > 0) and ($total == ($due + $discount + $paid))) {
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $acc_code,
                    'description' => 'Cash Portion of Sale',
                    'amount' => $paid,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $customerId,
                    'description' => 'Credit Portion with Discount',
                    'amount' => $due,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $discount_allowed,
                    'description' => 'Credit Portion with Discount',
                    'amount' => $discount,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $sales_revenue,
                    'description' => 'Credit Portion with Discount',
                    'amount' => $total,
                    'direction' => -1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                Transactions::insert($save_data);
            }

            // Partial Paid + Due (No Discount)
            if (($due > 0) and ($paid > 0) and ($discount == 0) and ($total == ($due + $paid))) {
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $acc_code,
                    'description' => 'Cash Portion of Sale',
                    'amount' => $paid,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $customerId,
                    'description' => 'Credit Portion of Sale',
                    'amount' => $due,
                    'direction' => 1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                $save_data[] = [
                    'trns_id' => $invoice_no,
                    'account_head_id' => $sales_revenue,
                    'description' => 'Credit Portion of Sale',
                    'amount' => $total,
                    'direction' => -1,
                    'trns_date' => $saleDate,
                    'store_id' => $store_id
                ];
                Transactions::insert($save_data);
            }


            DB::commit();


            // Prepare data for invoice
            $items = SaleProduct::where('invoice_no', $invoice_no)->get()->map(function ($p) {
                return [
                    'name' => $p->product->product_title ?? 'Unknown',
                    'qty' => $p->quantity,
                    'price' => $p->rate
                ];
            });

            $subtotal = collect($items)->sum(fn($item) => $item['qty'] * $item['price']);

            $datas = [
                'sale' => $sale,
                'items' => $items,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'paid' => $paid,
                'due' => $due,
                'customer_name' => $sale->customer->name ?? 'Walk-in',
                'sale_date' => $sale->created_at->format('Y-m-d H:i'),
                'invoice_no' => $invoice_no
            ];

            // Render HTML (for preview)
            $html = view('dashboard.admin.reports.accounts.pos_invoice', $datas)->render();

            // Return as JSON or open in new tab
            return response()->json([
                'code' => 1,
                'msg' => 'Product Sold Successfully',
                'invoice_html' => $html,
                'invoice_no' => $invoice_no
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['code' => 0, 'msg' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }



    protected function getOrCreateParentId($phone = null, $name = null, $email = null, $store_id)
    {
        return DB::transaction(function () use ($phone, $name, $email, $store_id) {

            // === Set proper name and phone defaults ===
            if (empty($name) && empty($phone)) {
                $name = "Walk-in Customer";
                $phone = "00000000000";
            } elseif (!empty($phone) && empty($name)) {
                $name = $phone; // Name = phone if name empty
            } elseif (!empty($name) && empty($phone)) {
                $phone = "00000000000"; // Default phone if phone empty
            }

            // === Helper to get next code safely ===
            $getNextCode = function () use ($store_id) {
                $maxCode = Account_Types::where(['account_head_id' => 1, 'store_id' => $store_id])->max('code');
                return $maxCode ? $maxCode + 1 : 1;
            };

            // === CASE 1: If phone exists → find customer or create new one ===
            if (!empty($phone)) {
                $customer = Customer::where('customer_phone', $phone)
                    ->where('store_id', $store_id)
                    ->first();

                if (!$customer) {
                    $newCode = $getNextCode();

                    // Create account type
                    $accounttype = new Account_Types();
                    $accounttype->account_type_hash_id = md5(uniqid(rand(), true));
                    $accounttype->account_head_id = 1;
                    $accounttype->account_name = $name;
                    $accounttype->store_id = $store_id;
                    $accounttype->is_money = 0;
                    $accounttype->code = $newCode;
                    $accounttype->normal = 1;
                    $accounttype->acc_type = 'customer';
                    $accounttype->acctype_status = 1;
                    $accounttype->save();

                    // Create customer
                    $customer = new Customer();
                    $customer->customer_hash_id = md5(uniqid(rand(), true));
                    $customer->customer_name = $name;
                    $customer->customer_phone = $phone;
                    $customer->customer_email = $email;
                    $customer->store_id = $store_id;
                    $customer->customer_status = 1;
                    $customer->parent_id = $newCode; // use code, not id
                    $customer->is_walkin = ($name == "Walk-in Customer") ? 1 : 0;
                    $customer->save();
                }

                return [
                    'parent_id' => $customer->parent_id,
                ];
            }

            // === CASE 2: No phone → create default walk-in customer ===
            $customer = Customer::where('is_walkin', 1)
                ->where('store_id', $store_id)
                ->first();

            if (!$customer) {
                $newCode = $getNextCode();

                // Create account type
                $accounttype = new Account_Types();
                $accounttype->account_type_hash_id = md5(uniqid(rand(), true));
                $accounttype->account_head_id = 1;
                $accounttype->account_name = "Walk-in Customer";
                $accounttype->store_id = $store_id;
                $accounttype->is_money = 0;
                $accounttype->code = $newCode;
                $accounttype->normal = 1;
                $accounttype->acc_type = 'customer';
                $accounttype->acctype_status = 1;
                $accounttype->save();

                // Create walk-in customer
                $customer = new Customer();
                $customer->customer_hash_id = md5(uniqid(rand(), true));
                $customer->customer_name = "Walk-in Customer";
                $customer->customer_phone = "00000000000";
                $customer->customer_email = null;
                $customer->store_id = $store_id;
                $customer->customer_status = 1;
                $customer->parent_id = $newCode;
                $customer->is_walkin = 1;
                $customer->save();
            }

            return [
                'parent_id' => $customer->parent_id,
            ];
        });
    }
}

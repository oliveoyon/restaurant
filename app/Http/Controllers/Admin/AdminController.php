<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Log;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $store_id = \Auth::guard('admin')->user()->store_id;
        $today = date('Y-m-d');
        $data['todaysale'] = DB::select("SELECT SUM(total) as totals FROM sales WHERE store_id = $store_id AND created_at LIKE '$today%';");
        $data['todaypurchase'] = DB::select("SELECT SUM(total) as totals FROM purchases WHERE store_id = $store_id AND purchase_date LIKE '$today%';");
        $data['receivable'] = DB::select("select tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code WHERE tr.account_head_id LIKE '1%' AND ac.acc_type = 'customer' AND tr.store_id = $store_id order by tr.account_head_id, ac.account_name;");
        $data['payable'] = DB::select("select tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code WHERE tr.account_head_id LIKE '2%' AND ac.acc_type = 'supplier' AND tr.store_id = $store_id order by tr.account_head_id, ac.account_name;");
        return view('dashboard.admin.home', $data);
    }

    public function todaysale()
    {
        $store_id = \Auth::guard('admin')->user()->store_id;
        $data['datetime'] = date('F j, Y');
        $data['settings'] = DB::table('general_settings')->where(['store_id' => $store_id])->first();
        $data['products'] = DB::table('sale_products')
            ->join('products', 'products.id', '=', 'sale_products.product_id')
            ->join('product_stocks', 'product_stocks.id', '=', 'sale_products.pdtstock_id')
            ->join('customers', 'customers.parent_id', '=', 'sale_products.customer_id')
            ->where('sale_products.store_id', '=', $store_id)
            ->whereBetween('sale_products.created_at', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59'])
            ->select('sale_products.*', 'products.product_title', 'customers.customer_name', 'product_stocks.barcode', 'product_stocks.serial_no', 'product_stocks.batch_no', 'product_stocks.size', 'product_stocks.color')
            ->get();

        $html1 = view('dashboard.admin.reports.sales.sale_products', $data)->render();

        if (!$data) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Todays Sale', 'html1' => $html1]);
        }
    }

    public function receivable()
    {
        $store_id = \Auth::guard('admin')->user()->store_id;
        $data['settings'] = DB::table('general_settings')->where(['store_id' => $store_id])->first();
        $data['customers'] = DB::select("select tr.account_head_id, sp.customer_address, sp.customer_phone, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code left join customers sp on ac.code = sp.parent_id WHERE tr.account_head_id LIKE '1%' AND ac.acc_type = 'customer' AND tr.store_id = $store_id group by ac.account_name order by tr.account_head_id, ac.account_name");

        $html1 = view('dashboard.admin.reports.sales.receivable', $data)->render();
        if (!$data) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Payable Customer List', 'html1' => $html1]);
        }
    }

    public function dashpayable()
    {
        $store_id = \Auth::guard('admin')->user()->store_id;
        $data['settings'] = DB::table('general_settings')->where(['store_id' => $store_id])->first();
        $data['suppliers'] = DB::select("select tr.account_head_id, sp.supplier_address, sp.supplier_phone, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code left join suppliers sp on ac.code = sp.parent_id WHERE tr.account_head_id LIKE '2%' AND ac.acc_type = 'supplier' AND tr.store_id = $store_id group by ac.account_name order by tr.account_head_id, ac.account_name");

        $html1 = view('dashboard.admin.reports.accounts.payable', $data)->render();
        if (!$data) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Payable Suppliers List', 'html1' => $html1]);
        }
    }

    public function todaypurchase()
    {
        $store_id = \Auth::guard('admin')->user()->store_id;
        $msg = date('F j, Y');
        $data['datetime'] = $msg;
        $data['settings'] = DB::table('general_settings')->where(['store_id' => $store_id])->first();

        $data['products'] = DB::table('product_stocks')
            ->join('products', 'products.id', '=', 'product_stocks.product_id')
            ->join('suppliers', 'suppliers.id', '=', 'product_stocks.supplier_id')
            ->where('product_stocks.invoice_no', 'like', 'PI-%')
            ->where('product_stocks.store_id', '=', $store_id)
            ->whereBetween('product_stocks.purchase_date', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59'])
            ->select('product_stocks.*', 'products.product_title', 'suppliers.supplier_name')
            ->get();
        $html1 = view('dashboard.admin.reports.accounts.purchase_products', $data)->render();

        if (!$data) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => $msg, 'html1' => $html1]);
        }
    }



    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:4|max:8'
        ], [
            'email.exists' => 'This email is not in db'
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login')->with('fail', 'Credential fails');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'cur_pass' => 'required|min:4|max:8',
            'new_pass' => 'required|min:4|max:8',
            'cnew_pass' => 'required|min:4|max:8|same:new_pass',
        ], [
            'cnew_pass.same' => 'Hello',
        ]);


        $data = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        if (\Hash::check($request->cur_pass, $data->password)) {
            $user = Admin::find($data->id);
            $user->password = \Hash::make($request->new_pass);
            $user->pin = '';
            $user->verify = 1;
            $user->update();
            return redirect()->back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে');
        } else {
            return redirect()->back()->with('fail', 'Fails');
        }
    }

    function logout()
    {
        //Auth::logout(); it will also work, or we can specify like bellow line as guard name
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}

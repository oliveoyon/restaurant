<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\productStock;
use App\Models\Admin\Unit;
use App\Models\ProductRecipe;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index()
    {
        // Group raw materials for each product
        $groupedRecipes = ProductRecipe::with('rawProduct')
            ->get()
            ->groupBy('product_id');

        $products = Product::whereIn('id', $groupedRecipes->keys())->get()->keyBy('id');

        return view('dashboard.admin.recipes.index', compact('groupedRecipes', 'products'));
    }


    public function create()
    {
        $products = Product::all(); // assuming all products include raw + finished
        $units = Unit::all();
        return view('dashboard.admin.recipes.create', compact('products', 'units'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'raw_product_id' => 'required|array',
            'raw_product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric|min:0.01',
        ]);

        $existing = ProductRecipe::where('product_id', $request->product_id)->exists();
        if ($existing) {
            return back()->withErrors(['product_id' => 'This product already has a recipe.'])->withInput();
        }

        $rawProducts = $request->input('raw_product_id');
        $quantities = $request->input('quantity');
        $units = $request->input('unit');

        // Optional: check if both arrays have same length
        if (count($rawProducts) !== count($quantities)) {
            return back()->withErrors(['quantity' => 'Mismatch in raw materials and quantities.']);
        }


        $totalBuyPrice = 0;

        $totalBuyPrice = 0;

        foreach ($rawProducts as $key => $rawId) {
            $qty = $quantities[$key];
            $unit = $units[$key];

            $product = Product::find($rawId); // get actual unit
            if (!$product) continue;

            $productUnit = $product->unit->unit_name ?? null;
            if (!$productUnit) continue;

            // Get all positive stock entries for that raw product
            $stocks = \DB::table('product_stocks')
                ->where('product_id', $rawId)
                ->where('quantity', '>', 0)
                ->get();

            $totalQty = 0;
            $totalValue = 0;

            foreach ($stocks as $s) {
                $totalQty += $s->quantity;
                $totalValue += ($s->buy_price * $s->quantity);
            }

            $averageUnitPrice = $totalQty > 0 ? $totalValue / $totalQty : 0;

            // Convert recipe unit to product unit if different
            $convertedQty = $this->convertUnits($qty, $unit, $productUnit); // your existing helper

            // Final cost of this item
            $itemCost = round($convertedQty * $averageUnitPrice, 2);
            $totalBuyPrice += $itemCost;

            // Save recipe item
            ProductRecipe::create([
                'product_id' => $request->product_id,
                'raw_product_id' => $rawId,
                'quantity' => $qty,
                'unit' => $unit,
            ]);
        }


        // add to stock
        $pdtStockHashId = Str::random(20);
        $batchNo = strtoupper(Str::random(8));
        $serialNo = strtoupper(Str::random(6));
        $barcode = strtoupper(Str::random(10));
        $purchaseDate = now()->format('Y-m-d');

        productStock::create([
            "pdt_stock_hash_id"   => $pdtStockHashId,
            "invoice_no"          => 'instant manufactured',
            "product_type"        => 2,
            "product_id"          => $request->product_id,
            "batch_no"            => $batchNo,
            "supplier_id"         => null,
            "shelf_id"            => null,
            "tax_id"              => 0,
            "tax_value_percent"   => 0,
            "stckpdt_image"       => null,
            "post_by"             => \Auth::guard('admin')->user()->id,
            "store_id"            => \Auth::guard('admin')->user()->store_id,
            "pdtstk_status"       => 1,
            "serial_no"           => $serialNo,
            "barcode"             => $barcode,
            "size"                => null,
            "color"               => null,
            "buy_price"           => round($request->input('sale_price'), 2),
            "buy_price_with_tax"  => round($request->input('sale_price'), 2),
            "sell_price"          => round($request->input('sale_price'), 2),
            "quantity"            => 0, // final product quantity
            "purchase_date"       => $purchaseDate,
            "expired_date"        => now()->addMonths(6)->format('Y-m-d'), // example
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);



        return redirect()->route('admin.recipes.index')->with('success', 'Recipe saved successfully.');
    }

    public function showRecipeDetails($product_id)
    {
        $recipes = ProductRecipe::with('rawProduct')
            ->where('product_id', $product_id)
            ->get();

        $product = Product::findOrFail($product_id);

        $recipeDetails = [];

        foreach ($recipes as $item) {
            $stockItems = \DB::table('product_stocks')
                ->where('product_id', $item->raw_product_id)
                ->where('quantity', '>', 0)
                ->get();

            $totalQty = $stockItems->sum('quantity');
            $totalValue = $stockItems->sum(function ($stock) {
                return $stock->quantity * $stock->buy_price;
            });

            $avgPrice = $totalQty > 0 ? $totalValue / $totalQty : 0;
            $itemCost = $item->quantity * $avgPrice;

            $recipeDetails[] = [
                'raw_product_title' => $item->rawProduct->product_title ?? 'N/A',
                'quantity' => $item->quantity,
                'unit' => $item->unit,
                'avg_price' => round($avgPrice, 2),
                'item_cost' => round($itemCost, 2),
            ];
        }

        $totalCost = array_sum(array_column($recipeDetails, 'item_cost'));

        return view('dashboard.admin.recipes.modal-details', compact('product', 'recipeDetails', 'totalCost'));
    }


    // function convertToBaseUnit($value, $from_unit, $to_unit)
    // {
    //     $conversion = [
    //         'kg' => 1000, // 1 kg = 1000 gm
    //         'gm' => 1,
    //         'ltr' => 1000,
    //         'ml' => 1,
    //         'pcs' => 1,
    //     ];

    //     if (!isset($conversion[$from_unit]) || !isset($conversion[$to_unit])) {
    //         throw new \Exception("Unit conversion not defined");
    //     }

    //     return $value * ($conversion[$from_unit] / $conversion[$to_unit]);
    // }

    private function convertUnits($quantity, $fromUnit, $toUnit)
    {
        $conversion = [
            'kg' => 1000,
            'gm' => 1,
            'ltr' => 1000,
            'ml' => 1,
            'pcs' => 1,
        ];

        if (!isset($conversion[$fromUnit]) || !isset($conversion[$toUnit])) {
            throw new \Exception("Unknown unit: $fromUnit or $toUnit");
        }

        // convert from source to base unit, then to target
        return $quantity * ($conversion[$fromUnit] / $conversion[$toUnit]);
    }
}

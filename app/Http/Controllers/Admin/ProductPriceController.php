<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\ProductStock;
use App\Models\Admin\Category;
use App\Models\Admin\Unit;
use Illuminate\Support\Facades\DB;

class ProductPriceController extends Controller
{

    public function editForm()
    {
        $categories = Category::where('category_status', 1)->get();
        $units = Unit::all();
        return view('dashboard.admin.productManagement.editProduct', compact('categories', 'units'));
    }

    public function getProductsByCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $products = Product::where('category_id', $request->category_id)->get();
        return response()->json($products);
    }

    public function getProductBatchStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $stocks = ProductStock::select(
            'product_stocks.*',
            'products.product_title',
            'products.unit_id',
            'products.category_id'
        )
            ->join('products', 'product_stocks.product_id', '=', 'products.id')
            ->where('product_stocks.product_id', $request->product_id)
            ->where('product_stocks.quantity', '>', 0)
            ->get();

        $units = Unit::all();
        $product = Product::find($request->product_id);

        return response()->json([
            'stocks' => $stocks,
            'units' => $units,
            'product' => $product
        ]);
    }



    public function updatePrices(Request $request)
    {
        $stockIds = $request->sell_prices ? array_keys($request->sell_prices) : [];

        DB::transaction(function () use ($request, $stockIds) {
            // Update sell prices if provided
            if ($request->sell_prices) {
                foreach ($request->sell_prices as $stockId => $price) {
                    ProductStock::where('id', $stockId)->update(['sell_price' => $price]);
                }
            }

            // Update product titles
            if ($request->product_titles) {
                foreach ($request->product_titles as $id => $title) {
                    if (in_array($id, $stockIds)) {
                        $productId = ProductStock::where('id', $id)->value('product_id');
                        Product::where('id', $productId)->update(['product_title' => $title]);
                    } else {
                        Product::where('id', $id)->update(['product_title' => $title]);
                    }
                }
            }

            // Update product units
            if ($request->units) {
                foreach ($request->units as $id => $unitId) {
                    if (in_array($id, $stockIds)) {
                        $productId = ProductStock::where('id', $id)->value('product_id');
                        Product::where('id', $productId)->update(['unit_id' => $unitId]);
                    } else {
                        Product::where('id', $id)->update(['unit_id' => $unitId]);
                    }
                }
            }

            // Update product categories
            if ($request->categories) {
                foreach ($request->categories as $id => $categoryId) {
                    if (in_array($id, $stockIds)) {
                        $productId = ProductStock::where('id', $id)->value('product_id');
                        Product::where('id', $productId)->update(['category_id' => $categoryId]);
                    } else {
                        Product::where('id', $id)->update(['category_id' => $categoryId]);
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Product info updated successfully.');
    }
}

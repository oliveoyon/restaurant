<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Production;
use App\Models\ProductionItem;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductionController extends Controller
{
    public function create()
    {
        $products = Product::all(); // Finished products
        return view('dashboard.admin.production.create', compact('products'));
    }

    public function getRecipe(Request $request)
    {
        $product_id = $request->input('product_id');
        $recipes = ProductRecipe::with('rawProduct')->where('product_id', $product_id)->get();

        return response()->json([
            'recipes' => $recipes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'production_date' => 'nullable|date',
        ]);

        // Create production record
        $production = Production::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'batch_no' => $request->batch_no,
            'production_date' => $request->production_date,
            'store_id' => 1, // or dynamic
            'created_by' => Auth::id() ?? 1,
            'note' => $request->note,
        ]);

        // Fetch recipe and multiply
        $recipes = ProductRecipe::where('product_id', $request->product_id)->get();

        foreach ($recipes as $recipe) {
            ProductionItem::create([
                'production_id' => $production->id,
                'raw_product_id' => $recipe->raw_product_id,
                'quantity_used' => $recipe->quantity * $request->quantity,
                'unit' => $recipe->unit,
            ]);

            // (Optional) Deduct raw material from inventory here
        }

        // (Optional) Add finished product stock here

        return redirect()->route('admin.productions.index')->with('success', 'Production recorded successfully.');
    }

    public function index()
    {
        $productions = Production::with('product')->latest()->get();
        return view('dashboard.admin.production.index', compact('productions'));
    }

    public function show($id)
    {
        $production = Production::with('product', 'items.rawProduct')->findOrFail($id);
        $rawMaterials = $production->items;

        return view('dashboard.admin.production.show', compact('production', 'rawMaterials'));

    }
}

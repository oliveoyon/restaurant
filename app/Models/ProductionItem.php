<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\Production;

class ProductionItem extends Model
{
    use HasFactory;
    protected $fillable = [
    'production_id',
    'raw_product_id',
    'quantity_used',
    'unit',
];

    // ProductRecipe.php
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function rawProduct() {
        return $this->belongsTo(Product::class, 'raw_product_id');
    }
    

}

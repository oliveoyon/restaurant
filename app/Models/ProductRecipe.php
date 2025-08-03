<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;

class ProductRecipe extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'raw_product_id', 'quantity', 'unit'];


    // ProductRecipe.php
    public function product() { // finished product
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function rawProduct() { // raw product
        return $this->belongsTo(Product::class, 'raw_product_id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\ProductionItem;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
    'product_id',
    'quantity',
    'batch_no',
    'production_date',
    'store_id',
    'created_by',
    'note',
];

    // ProductRecipe.php
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function rawProduct() {
        return $this->belongsTo(Product::class, 'raw_product_id');
    }

    public function items()
    {
        return $this->hasMany(ProductionItem::class);
    }

}

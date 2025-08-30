<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_hash_id',
        'customer_id',
        'product_id',
        'pdtstock_id',
        'quantity',
        'rate',
        'invoice_no',
        'sale_by',
        'store_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

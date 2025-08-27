<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
   
    protected $fillable = [
    'pdt_stock_hash_id',
    'invoice_no',
    'product_type',
    'product_id',
    'batch_no',
    'supplier_id',
    'shelf_id',
    'tax_id',
    'tax_value_percent',
    'stckpdt_image',
    'post_by',
    'store_id',
    'pdtstk_status',
    'serial_no',
    'barcode',
    'size',
    'color',
    'buy_price',
    'buy_price_with_tax',
    'sell_price',
    'quantity',
    'purchase_date',
    'expired_date',
];

public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}


}

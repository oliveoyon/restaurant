<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;

    protected $table = 'purchased_products';

    protected $fillable = [
        'invoice_no',
        'product_type',
        'product_id',
        'batch_no',
        'supplier_id',
        'shelf_id',
        'tax_id',
        'tax_value_percent',
        'stckpdt_image',
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
        'post_by',
        'store_id',
        'status',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'expired_date' => 'datetime',
    ];
}

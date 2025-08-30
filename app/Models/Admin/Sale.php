<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_no',
        'total',
        'discount',
        'paid',
        'due',
        'sale_status',
        'store_id',
        'trns_type',
        'description',
        'check_pending',
        'created_at',
    ];
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'customer_hash_id',
    'customer_name',
    'customer_address',
    'customer_phone',
    'customer_email',
    'store_id',
    'customer_status',
    'parent_id',
    'is_walkin',
];

}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'trns_id',
        'account_head_id',
        'description',
        'amount',
        'direction',
        'trns_date',
        'store_id',
        // add any other fields you're mass assigning
    ];
}

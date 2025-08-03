<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Account_Types;

class WalletTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_type_id',
        'wallet_name',
        'transfer_date',
        'gross_amount',
        'fee_percentage',
        'fee_amount',
        'net_amount',
        'bank_account',
        'remarks',
    ];

    // Relationship to the ledger account (account_types)
    public function accountType()
    {
        return $this->belongsTo(Account_Types::class);
    }
}

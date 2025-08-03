<?php

namespace App\Models;

use App\Models\Admin\Product;
use App\Models\Admin\productStock;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id',
        'batch_no',
        'quantity_deducted',
        'reason',
        'store_id',
        'reference',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function batch()
    {
        return $this->belongsTo(productStock::class, 'batch_no');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'done_by');
    }
}

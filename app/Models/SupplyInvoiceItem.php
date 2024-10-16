<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplyInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_invoice_id', 'product_id', 'quantity', 'cost_price'
    ];

    public function supplyInvoice() : BelongsTo
    {
        return $this->belongsTo(SupplyInvoice::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

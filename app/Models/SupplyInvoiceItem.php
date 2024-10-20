<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplyInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_invoice_id', 'product_id', 'quantity', 'cost_price', 'status'
    ];

    public function supplyInvoice() : BelongsTo
    {
        return $this->belongsTo(SupplyInvoice::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Query Scopes
     * status: 'composed', 'stocked', 'canceled
     */
    public function scopeComposed($query)
    {
        return $query->where('status', 'composed');
    }

    public function scopeStocked($query)
    {
        return $query->where('status', 'stocked');
    }
    public function scopeCanceled($query)
    {
        return $query->where('status', 'canceled');
    }
}

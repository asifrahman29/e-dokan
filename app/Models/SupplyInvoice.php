<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplyInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id', 'invoice_number', 'invoice_date', 'total_amount', 'status'
    ];

    /**
     * # Relationships
     * belongsTo: supplier
     * hasMany: supplyInvoiceItem as items
     */
    public function supplier() : BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items() : HasMany
    {
        return $this->hasMany(SupplyInvoiceItem::class);
    }

    /**
     * Query Scopes
     * status: 'composed', 'stocked', 'canceled
     * search, count SupplyInvoiceItem, count SupplyInvoiceItem quantity
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

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function ($query) use ($term) {
            $query->where('invoice_number', 'like', $term)
                ->orWhere('invoice_date', 'like', $term);
        });
    }

    public function scopeItemsCount($query)
    {
        return $query->withCount('items');
    }

    public function scopeItemsCountQuantity($query)
    {
        return $query->withSum('items', 'quantity');
    }

    /**
     * previousRoute nextRoute
     */
    public function nextRoute($route)
    {
        $next = static::where('id', '>', $this->id)
            ->orderBy('id', 'asc')
            ->value('id');
        return $next ? route($route, $next) : '';
    }

    public function previousRoute($route)
    {
        $previous = static::where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->value('id');
        return $previous ? route($route, $previous) : '';
    }
}

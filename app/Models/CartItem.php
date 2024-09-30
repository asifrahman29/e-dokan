<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * # Relationships
     * belongs to user, product
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Local Scopes query
     * 
     */
    public function getQuantityAttribute($value)
    {
        return (int) $value;
    }

    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = (int) $value;
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }

    public function getFormattedSubtotalAttribute()
    {
        return number_format($this->subtotal, 2);
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->product->price, 2);
    }

    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 2);
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }
}

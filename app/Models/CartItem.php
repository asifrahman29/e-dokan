<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * belongs to user, product
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_purchase',
        'max_uses',
        'uses',
        'start_date',
        'expiry_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    /**
     * Relationships: has many orders
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * 
     */
    public function isExpired()
    {
        return $this->expiry_date < now();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeExpired($query)
    {
        return $query->where('is_active', 1)->where('expiry_date', '<', now());
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_active', 1)->where('expiry_date', '>', now());
    }
}

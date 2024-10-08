<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coupon_code',
        'order_number',
        'total_price',
        'shipping_address',
        'order_date',
        'status',
    ];

    /**
     * # Relationships
     * belongsto: user, coupon_code
     */

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon() : BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * # Relationships
     * has many: orderItems
     * has one: payment
     */
    public function orderItems() : HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment() : HasOne
    {
        return $this->hasOne(Payment::class);
    }
    
    /**
     * # query
     * status
     * ['pending', 'shipped', 'delivered', 'cancelled']
     */
    public function orderPending($query)
    {
        return $query->where('status', 'pending');
    }

    public function orderShipped($query)
    {
        return $query->where('status', 'shipped');
    }

    public function orderDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    public function orderCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'slug',
        'product_image',
        'category_id',
        'subcategory_id',
        'brand_id',
        'status',
    ];

    /**
     * # Relationships
     * belongsTo: category, subcategory, brand
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory() : BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * # Relationships
     * has many :carts, reviews, orders, wishlists
     * has one : productAttribute
     */

     public function carts() : HasMany
     {
         return $this->hasMany(CartItem::class);
     }
     
    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function wishlists() : HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function productAttributes() : HasOne
    {
        return $this->hasOne(ProductAttribute::class);
    }



    /**
     * # Query
     * available : quantity, active, recent
     */
    public function available($query)
    {
        return $query->where('quantity', '>', 1);
    }
    public function active($query)
    {
        return $query->where('status', 1);
    }
    public function recent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    /**
     * Get the image in strage
     */
    public function getImage($value)
    {
        return asset('storage/product/image' . $value);
    }
    /**
     * set/save the image use store() mrthod
     */
    public function setImage($value)
    

}

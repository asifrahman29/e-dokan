<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * Relationships
     * belongsTo: category, subcategory, brand
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relationships
     * has many : carts, reviews, orders, wishlists
     * has one : productAttribute
     */
    public function carts(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function productAttributes(): HasOne
    {
        return $this->hasOne(ProductAttribute::class);
    }

    /**
     * Query Scopes
     * available : quantity, active, recent
     */
    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    /**
     * Handle the product image (set and get)
     */
    protected function productImage(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if ($value instanceof \Illuminate\Http\UploadedFile) {
                    $path = $value->store('products/images', 'public');
                    return $path;
                }
                return $value;
            },
            get: fn($value) => asset('storage/' . $value),
        );
    }

    /**
     * Pluck Id Name
     */
    public static function plucking()
    {
        return self::pluck('name', 'id');
    }
    /**
     * product search by name and slug
     */
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('slug', 'like', $term)
                ->orWhereHas('brand', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                });
        });
    }
}

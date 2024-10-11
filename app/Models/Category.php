<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'is_active',
    ];

    /**
     * Relationships: has many subcategories, products.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * active categories.
     */
    public function active($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Handle the icon attribute using Accessor and Mutator.
     */
    protected function icon(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if ($value instanceof \Illuminate\Http\UploadedFile) {
                    $path = $value->store('category/icons', 'public');
                    return $path;
                }
                return $value;
            },
            get: fn($value) => asset('storage/' . $value),
        );
    }

    /**
     * Pluck name id
     */
    public static function plucking()
    {
        return self::pluck('name', 'id');
    }
}

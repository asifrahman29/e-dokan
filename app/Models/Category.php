<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
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
     * Accessor: Get full icon URL from storage.
     */
    public function getIconAttribute($value)
    {
        return asset('storage/' . $value);
    }

    /**
     * Mutator: Store icon in 'category/icons' folder inside 'public' disk.
     */
    public function setIconAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $path = $value->store('category/icons', 'public');
            $this->attributes['icon'] = $path;
        } else {
            $this->attributes['icon'] = $value;
        }
    }
}

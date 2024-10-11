<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    /**
     * # Relationships
     * has many products.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Local Scopes query
     * 
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Pluck name id
     */
    public static function plucking()
    {
        return self::pluck('name', 'id');
    }
}

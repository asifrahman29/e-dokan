<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'is_active',
    ];

    /**
     * # Relationships
     * belogs to : category
     * has many : products
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    
    /**
     * Scope query
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}

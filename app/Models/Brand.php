<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    /**
     * has many products.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function active($query)
    {
        return $query->where('is_active', 1);
    }

}

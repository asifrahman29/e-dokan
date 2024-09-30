<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute_name',
        'attribute_value',
    ];

    /**
     * # Relationships
     * belongs to : product
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

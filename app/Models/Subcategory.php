<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'is_active',
    ];

    // one to many > category belogsto in subcategory
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function active($query)
    {
        return $query->where('is_active', 1);
    }
}

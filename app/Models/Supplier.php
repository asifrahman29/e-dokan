<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email', 'phone', 'company_name', 'address'
    ];

    /**
     * # Relationships
     * HasMany: SupplyInvoice as invoices
     */
    public function invoices() : HasMany
    {
        return $this->hasMany(SupplyInvoice::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('phone', 'like', $term)
                ->orWhere('company_name', 'like', $term);
        });
    }
}

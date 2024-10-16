<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id', 'invoice_number', 'invoice_date', 'total_amount'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(SupplyInvoiceItem::class);
    }
}

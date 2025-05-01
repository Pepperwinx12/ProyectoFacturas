<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'customer_id',
        'receipt_type',
        'receipt_series',
        'receipt_number',
        'date_time',
        'tax',
        'total_sale'
    ];

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

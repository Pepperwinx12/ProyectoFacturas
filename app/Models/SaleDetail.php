<?php

// app/Models/SaleDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Item::class, 'product_id');
    }

   
     public function item()
     {
     return $this->belongsTo(Item::class);
      }
      

}

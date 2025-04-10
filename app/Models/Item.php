<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $fillable = ['category_id', 'code', 'name', 'stock', 'description', 'image', 'status'];

    // Relations: one Item belongs to one Category

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}

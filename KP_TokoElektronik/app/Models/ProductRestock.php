<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRestock extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'product_restock';
    protected $fillable = ['quantity', 'products_id'];


    public function products()
    {
        return $this->belongsTo(Products::class, 'products_id');
    }
}

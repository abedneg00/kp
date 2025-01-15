<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    use SoftDeletes;

    public function transactions()  
    {  
        return $this->hasMany(Transactions::class, 'products_id');  
    }  
    
}

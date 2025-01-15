<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class Transactions extends Model  
{  
    use HasFactory;  
  
    // Nama tabel yang digunakan  
    protected $table = 'transactions';  
    public $timestamps = false;
    protected $fillable = ['no_penjualan','quantity_sold', 'total_price', 'payment_method', 'products_id', 'users_id'];

  
    // Relasi dengan model User  
    public function user()  
    {  
        return $this->belongsTo(User::class, 'users_id');  
    }  
  
    // Relasi dengan model Product  
    public function product()  
    {  
        return $this->belongsTo(Products::class, 'products_id');  
    }  
}  

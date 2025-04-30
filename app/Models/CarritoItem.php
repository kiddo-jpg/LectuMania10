<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Libros;

class CarritoItem extends Model
{
    use HasFactory;

    protected $fillable = ['carrito_id', 'libro_id', 'cantidad', 'precio'];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }

    public function libro()
    {
        return $this->belongsTo(Libros::class, 'libro_id');
    }
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id'];

    public function items()
    {
        return $this->hasMany(CarritoItem::class, 'carrito_id');
    }
}
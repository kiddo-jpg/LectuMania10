<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'editorial',
        'anio',
        'genero',
        'portada',
        'isbn',
        'paginas',
        'idioma',
        'numeroEjemplares',
        'precio',
    ];
}
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar a Authenticatable
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Authenticatable
{
    protected $table = 'usuarios'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = true; // Habilitar timestamps (created_at y updated_at)

    protected $fillable = [
        'nombre',
        'usuario',
        'password',
        'foto',
        'rol',
        'estado',
        'email',    
        'telefono',
        'direccion',
    ];

    // Ocultar la contraseña al serializar el modelo
    protected $hidden = [
        'password',
    ];

    // Valor predeterminado para el campo "rol"
    protected $attributes = [
        'rol' => 'usuario',
    ];
}
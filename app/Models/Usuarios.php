<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Usuarios extends Model implements Authenticatable
{
    use AuthenticatableTrait;



 

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuarios';
    
    protected $fillable = [
        'nombre_u',
        'correo_u',
        'contraseña_u',
        'tipo_u',
        'telefono_u',
        'direccion_u',
        'genero_u',
        'fecha_u',
        'foto_u',
    ];

    
}

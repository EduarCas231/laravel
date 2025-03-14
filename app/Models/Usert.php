<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usert extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'tb_usert';

    // Especificar la clave primaria si es diferente de 'id'
    protected $primaryKey = 'id_usert';

    
    protected $fillable = [
        'nombre_u',
        'correo_u',
        'direccion_u',
        'estado_u',
        'municipio_u',
        'foto_u',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    use HasFactory;

    // Define el nombre de la tabla
    protected $table = 'accesos';

    // Especifica los campos que son asignables de manera masiva
    protected $fillable = [
        'accion',
        'fecha',
    ];

    // Si no deseas que se use el campo `created_at` o `updated_at`, puedes desactivarlos
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_productos';

    protected $fillable = [
        'name_p',
        'Noserie_p',        
        'modelo_p',
        'region_p',
        'detalle_p',
        'foto_p',
    ];
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuarios');
            $table->string('nombre_u');
            $table->string('correo_u');
            $table->string('contraseña_u');
            $table->boolean('tipo_u');
            $table->string('telefono_u');
            $table->string('direccion_u');
            $table->date('fecha_u');
            $table->text('foto_u');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_usert', function (Blueprint $table) {
            $table->id('id_usert');
            $table->string('nombre_u');
            $table->string('correo_u');
            $table->string('direccion_u');
            $table->string('estado_u');
            $table->string('municipio_u');
            $table->text('foto_u');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_usert');
    }
};

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
        Schema::create('respuestacomentario', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->timestamp('fecha_respuesta');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('comentario_id');
            

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('comentario_id')->references('id')->on('comentarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestacomentarios');
    }
};

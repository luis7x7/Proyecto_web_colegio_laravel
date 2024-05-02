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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->timestamp('fecha_comentario');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('publicacion_id');
            $table->unsignedBigInteger('comentario_padre_id')->nullable();

            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('publicacion_id')->references('id')->on('publicaciones');

            $table->foreign('comentario_padre_id')->references('id')->on('comentarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('comentarios');
    }
};

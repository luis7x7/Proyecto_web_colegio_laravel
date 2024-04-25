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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->string('Sub_tema', 50);
            $table->text('contenido');
            $table->string('imagen');
            $table->timestamp('fecha_publicacion');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('tema_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            // Claves externas
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('tema_id')->references('id')->on('temas')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};

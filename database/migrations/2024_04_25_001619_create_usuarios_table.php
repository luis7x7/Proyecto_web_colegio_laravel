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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email');
            $table->string('password');
            $table->unsignedBigInteger('rol_id'); // Cambiado a unsignedBigInteger para ID de rol
            $table->string('imagen_usuario');
            $table->timestamps();

            // Clave externa para rol_id
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade'); // Asumiendo que existe una tabla de roles
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

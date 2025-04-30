<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('libros'); // Eliminar la tabla si existe
        Schema::create('libros', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED NOT NULL
            $table->string('titulo'); // varchar(255) NOT NULL
            $table->string('autor'); // varchar(255) NOT NULL
            $table->string('editorial'); // varchar(255) NOT NULL
            $table->string('isbn'); // varchar(255) NOT NULL
            $table->integer('anio'); // int(11) NOT NULL
            $table->integer('paginas'); // int(11) NOT NULL
            $table->string('genero'); // varchar(255) NOT NULL
            $table->string('idioma'); // varchar(255) NOT NULL
            $table->integer('numeroEjemplares'); // int(11) NOT NULL
            $table->integer('precio'); // int(11) NOT NULL
            $table->integer('estado')->default(1); // int(11) NOT NULL DEFAULT 1
            $table->string('portada')->nullable(); // varchar(255) DEFAULT NULL
            $table->timestamps(0); // created_at y updated_at como timestamp NULL DEFAULT NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};


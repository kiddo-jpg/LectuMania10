<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrito_id'); // Relación con el carrito
            $table->unsignedBigInteger('libro_id'); // Relación con el libro
            $table->unsignedInteger('cantidad'); // Cantidad de libros
            $table->decimal('precio', 10, 2); // Precio del libro
            $table->timestamps();
        
            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');
            $table->foreign('libro_id')->references('id')->on('libros')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_items');
    }
};

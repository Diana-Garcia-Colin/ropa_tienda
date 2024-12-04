<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id(); // ID único para la tabla
            // Definir la relación con la tabla 'tickets'
            $table->unsignedBigInteger('id_ticket'); // Especificar el tipo de la columna
            $table->foreign('id_ticket')->references('id_ticket')->on('tickets')->onDelete('cascade'); // Relación con 'tickets'
            
            // Definir la relación con la tabla 'productos'
            $table->unsignedBigInteger('id_producto'); // Especificar el tipo de la columna
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade'); // Relación con 'productos'
            
            // Definir la relación con la tabla 'asig_talla'
            $table->unsignedBigInteger('id_asigt'); // Especificar el tipo de la columna
            $table->foreign('id_asigt')->references('id')->on('asig_talla')->onDelete('cascade'); // Relación con 'asig_talla'
            
            // Otros campos de la tabla 'ventas'
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('id_ticket'); // ID único para tickets
            $table->date('fecha_ventas'); // Fecha de la venta
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente')->onDelete('cascade'); // Relación con clientes
            $table->foreignId('id_empleado')->constrained('empleados', 'id_empleado')->onDelete('cascade'); // Relación con empleados
            $table->decimal('total', 10, 2); // Total de la venta
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

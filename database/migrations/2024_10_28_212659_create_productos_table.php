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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_tipo_ropa')
                ->constrained('tipo_ropas')
                ->onDelete('cascade'); // Eliminar productos si se elimina el tipo de ropa

            $table->decimal('precio', 10, 2); // Columna para el precio del producto

            // Clave foránea que referencia a la tabla 'marcas'
            $table->foreign('id_marca')
                ->references('id')
                ->on('marcas')
                ->onDelete('cascade'); // Eliminar productos si se elimina la marca

            // Clave foránea que referencia a la tabla 'categorias'
            $table->foreignId('id_categoria')
                ->constrained('categorias')
                ->onDelete('cascade'); // Eliminar productos si se elimina la categoría

            $table->string('imagen')->nullable(); // Columna para almacenar la imagen, opcional

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

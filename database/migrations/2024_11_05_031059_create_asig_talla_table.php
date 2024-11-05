<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asig_talla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_entrada')->constrained('entradas')->onDelete('cascade');
            $table->integer('cantidad');
            $table->foreignId('id_talla')->constrained('tallas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asig_talla');
    }
};

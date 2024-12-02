<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tipo')->nullable(); // Campo id_tipo
            $table->foreign('id_tipo')->references('id')->on('roles')->onDelete('set null'); // Llave foránea
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_tipo']);
            $table->dropColumn('id_tipo');
        });
    }
};
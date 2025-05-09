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
        Schema::table('items', function (Blueprint $table) {
            // Agregar la clave foránea
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            // Agregar columna 'price' (que puede ser null)
            $table->decimal('price', 10, 2)->nullable();  // Puedes ajustar la precisión si es necesario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['category_id']);
            
            // Eliminar la columna 'price'
            $table->dropColumn('price');
        });
    }
};

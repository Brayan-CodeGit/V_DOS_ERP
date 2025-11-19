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
        // 1. Modificar la tabla 'recetas'
        Schema::table('recetas', function (Blueprint $table) {
            // Eliminar la FK existente que apunta a productos
            $table->dropForeign(['ID_Producto_Final']);

            // Recrear la FK con onDelete('cascade')
            $table->foreign('ID_Producto_Final')
                  ->references('ID_Producto')
                  ->on('productos')
                  ->onDelete('cascade'); 
        });

        // 2. Modificar la tabla 'detalle_receta'
        Schema::table('detalle_receta', function (Blueprint $table) {
            // Eliminar la FK existente (la que apunta a Producto Componente)
            $table->dropForeign(['ID_Producto_Componente']);

            // Recrear la FK con onDelete('cascade')
            $table->foreign('ID_Producto_Componente')
                  ->references('ID_Producto')
                  ->on('productos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Al revertir (rollback), volvemos a dejar las FKs sin 'cascade'
        
        // 1. Revertir tabla 'recetas'
        Schema::table('recetas', function (Blueprint $table) {
            $table->dropForeign(['ID_Producto_Final']);
            $table->foreign('ID_Producto_Final')
                  ->references('ID_Producto')
                  ->on('productos'); // Sin cascade
        });

        // 2. Revertir tabla 'detalle_receta'
        Schema::table('detalle_receta', function (Blueprint $table) {
            $table->dropForeign(['ID_Producto_Componente']);
            $table->foreign('ID_Producto_Componente')
                  ->references('ID_Producto')
                  ->on('productos'); // Sin cascade
        });
    }
};
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
        Schema::create('detalle_receta', function (Blueprint $table) {
            $table->id('ID_Detalle');
            
            // Clave foránea a la tabla 'recetas'
            $table->foreignId('ID_Receta')
                  ->constrained('recetas', 'ID_Receta')
                  ->onDelete('cascade'); // Si se elimina la receta, se elimina el detalle
            
            // Clave foránea al producto que se consume (MP o SE)
            $table->foreignId('ID_Producto_Componente')
                  ->constrained('productos', 'ID_Producto')
                  ->onDelete('restrict'); 

            $table->decimal('Cantidad_Necesaria', 10, 4);
            $table->string('Unidad_Consumo', 10);
            
            // Restricción UNIQUE (ID_Receta, ID_Producto_Componente)
            $table->unique(['ID_Receta', 'ID_Producto_Componente']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_receta');
    }
};

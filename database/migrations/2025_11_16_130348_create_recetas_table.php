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
        Schema::create('recetas', function (Blueprint $table) {
            $table->id('ID_Receta');
            $table->string('Nombre_Receta', 255);
            $table->decimal('Rendimiento', 10, 2);
            $table->string('Unidad_Rendimiento', 10);
            
            // Clave foránea a la tabla 'productos'
            $table->foreignId('ID_Producto_Final')->nullable()
                  ->constrained('productos', 'ID_Producto');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};

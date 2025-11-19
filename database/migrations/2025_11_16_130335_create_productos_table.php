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
            // El ID de Laravel por defecto es autoincremental y la clave primaria
            $table->id('ID_Producto'); 
            $table->string('Nombre', 255);
            $table->string('Codigo_SKU', 50)->unique();
            
            // Tipo_Producto con restricción CHECK usando enum (más idiomático en Laravel)
            $table->enum('Tipo_Producto', ['Materia Prima', 'Semielaborado', 'Producto Final', 'Suministro']);
            
            $table->string('Unidad_Medida', 10);
            
            // DECIMAL(10, 2) con DEFAULT 0.00
            $table->decimal('Costo_Estandar', 10, 2)->default(0.00); 
            
            // BOOLEAN con DEFAULT TRUE
            $table->boolean('Es_Inventariable')->default(true); 

            $table->timestamps(); // created_at y updated_at
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

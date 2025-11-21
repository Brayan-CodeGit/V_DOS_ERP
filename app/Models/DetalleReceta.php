<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetalleReceta extends Model
{
    use HasFactory;

    // 1. Configuración de la tabla y clave primaria
    protected $table = 'detalle_receta';
    protected $primaryKey = 'ID_Detalle';
    public $incrementing = true;
    
    // 2. Campos asignables
    protected $fillable = [
        'ID_Receta',
        'ID_Producto_Componente',
        'Cantidad_Necesaria',
        'Unidad_Consumo',
    ];

    // 3. Relación: El detalle pertenece a UNA Receta (N:1)
    public function receta(): BelongsTo
    {
        return $this->belongsTo(Receta::class, 'ID_Receta', 'ID_Receta');
    }

    // 4. Relación: El detalle pertenece a UN Producto Componente (N:1)
    public function productoComponente(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'ID_Producto_Componente', 'ID_Producto');
    }
    
    // Alias para la relación del producto componente (para compatibilidad en Blade)
    public function componente(): BelongsTo 
    {
         return $this->productoComponente();
    }

    /**
     * Get the route key for the model.
     * Esto asegura que Laravel use 'ID_Detalle' para la inyección de modelos en las rutas.
     */
    public function getRouteKeyName(): string
    {
        return 'ID_Detalle';
    }
    
    // NOTA: Los métodos 'detalles()' y 'esComponenteDe()' están definidos de forma inusual 
    // en este modelo, ya que son relaciones de tipo 'hasMany' que generalmente van en los 
    // modelos 'Receta' y 'Producto' respectivamente. Se mantienen por si son necesarios 
    // para otros fines en la aplicación, pero su definición correcta es la siguiente:

    // Este debería ir en Receta.php
    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleReceta::class, 'ID_Receta', 'ID_Receta');
    }
    
    // Este debería ir en Producto.php
    public function esComponenteDe(): HasMany
    {
        return $this->hasMany(DetalleReceta::class, 'ID_Producto_Componente', 'ID_Producto');
    }
}
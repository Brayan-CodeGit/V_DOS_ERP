<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function getRouteKeyName(): string
    {
        return 'ID_Detalle';
    }
    public function detalles()
    {
        // Usa la FK 'ID_Receta' y la PK 'ID_Receta'
        return $this->hasMany(DetalleReceta::class, 'ID_Receta', 'ID_Receta');
    }
    public function esComponenteDe()
{
    // Usa la FK 'ID_Producto_Componente' y la PK 'ID_Producto'
    return $this->hasMany(DetalleReceta::class, 'ID_Producto_Componente', 'ID_Producto');
}
}
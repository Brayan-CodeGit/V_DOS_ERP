<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receta extends Model
{
    use HasFactory;

    // 1. Configuración de la tabla y clave primaria
    protected $table = 'recetas';
    protected $primaryKey = 'ID_Receta';
    public $incrementing = true;
    
    // 2. Campos asignables
    protected $fillable = [
        'Nombre_Receta',
        'Rendimiento',
        'Unidad_Rendimiento',
        'ID_Producto_Final',
    ];

    // 3. Relación: La receta PRODUCE UN Producto Final (1:1 o 1:N inversa)
    public function productoFinal(): BelongsTo
    {
        // Esta tabla tiene la clave foránea ID_Producto_Final
        return $this->belongsTo(Producto::class, 'ID_Producto_Final', 'ID_Producto');
    }

    // 4. Relación: Una Receta tiene MÚLTIPLES Componentes (1:N a través de DetalleReceta)
    public function componentes(): HasMany
    {
        // La tabla 'detalle_receta' tiene la clave foránea ID_Receta
        return $this->hasMany(DetalleReceta::class, 'ID_Receta', 'ID_Receta');
    }
    public function getRouteKeyName(): string
    {
        return 'ID_Receta';
    }
    public function detalles()
{
    // Usar la FK 'ID_Receta' en DetalleReceta y la PK 'ID_Receta' en Receta
    return $this->hasMany(DetalleReceta::class, 'ID_Receta', 'ID_Receta');
}
}
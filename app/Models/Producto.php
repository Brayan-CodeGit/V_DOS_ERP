<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    use HasFactory;

    // 1. Configuración de la tabla y clave primaria
    protected $table = 'productos';
    protected $primaryKey = 'ID_Producto';
    public $incrementing = true; 
    
    // 2. Campos que se pueden asignar masivamente (fillable)
    protected $fillable = [
        'Nombre',
        'Codigo_SKU',
        'Tipo_Producto',
        'Unidad_Medida',
        'Costo_Estandar',
        'Es_Inventariable',
    ];

    // 3. Relación: Un Producto Final puede ser producido por UNA Receta (inversa de la FK en Recetas)
    public function recetaQueProduce(): HasMany
    {
        // Un Producto es el ID_Producto_Final en la tabla 'recetas'
        return $this->hasMany(Receta::class, 'ID_Producto_Final', 'ID_Producto');
    }

    // 4. Relación: Un Producto puede ser COMPONENTE de MÚLTIPLES recetas (N:M a través de DetalleReceta)
    public function seConsumeEnRecetas(): HasMany
    {
        // Un Producto es el ID_Producto_Componente en la tabla 'detalle_receta'
        return $this->hasMany(DetalleReceta::class, 'ID_Producto_Componente', 'ID_Producto');
    }
    /* public function getRouteKeyName(): string
    {
        return 'ID_Producto';
    } */
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    // 1. Configuración de la tabla y clave primaria
    protected $table = 'almacenes';
    protected $primaryKey = 'ID_Almacen';
    public $incrementing = true;
    
    // 2. Campos asignables
    protected $fillable = [
        'Nombre_Almacen',
        'Direccion',
    ];

    public function getRouteKeyName(): string
    {
        return 'ID_Almacen';
    }
    // (Aquí irían relaciones futuras, como inventario en este almacén)
}
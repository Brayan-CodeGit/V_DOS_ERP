<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\DetalleReceta;
use App\Models\Producto;

class DetalleRecetaController extends Controller
{
    // 💡 El método store se ejecuta desde la vista de edición de la receta.
    public function store(Request $request, Receta $receta)
    {
        $request->validate([
            'ID_Producto_Componente' => 'required|exists:productos,ID_Producto',
            'Cantidad_Necesaria' => 'required|numeric|min:0.0001',
            'Unidad_Consumo' => 'required|string|max:10',
        ]);

        // *Añadido: Verificar si el componente ya existe para evitar duplicados*
        if ($receta->detalles()->where('ID_Producto_Componente', $request->ID_Producto_Componente)->exists()) {
             return redirect()->route('admin.recetas.edit', $receta)
                              ->with('error', 'Este componente ya ha sido agregado a la receta. Edita la cantidad si es necesario.');
        }

        $receta->detalles()->create($request->all());
        
        // Redirigimos de vuelta a la vista de edición de la receta
        return redirect()->route('admin.recetas.edit', $receta)
                            ->with('success', 'Componente agregado exitosamente.');
    }

    // El método edit permite modificar un detalle específico.
    public function edit(Receta $receta, DetalleReceta $detalle)
    {
        // Cargamos los productos para el selector (solo MP y SE)
        $componentes = Producto::whereIn('Tipo_Producto', ['MP', 'SE'])
                               ->pluck('Nombre', 'ID_Producto');
                               
        return view('admin.recetas.detalles.edit', compact('receta', 'detalle', 'componentes'));
    }

    // El método update actualiza un detalle específico.
    public function update(Request $request, Receta $receta, DetalleReceta $detalle)
    {
        $request->validate([
            'ID_Producto_Componente' => 'required|exists:productos,ID_Producto',
            'Cantidad_Necesaria' => 'required|numeric|min:0.0001',
            // CORREGIDO: Usar Unidad_Consumo en la validación/modelo de DetalleReceta
            'Unidad_Consumo' => 'required|string|max:10', 
        ]);

        $detalle->update($request->all());

        return redirect()->route('admin.recetas.edit', $receta)
                            ->with('success', 'Componente actualizado exitosamente.');
    }

    // El método destroy elimina un detalle específico.
    public function destroy(Receta $receta, DetalleReceta $detalle)
    {
        $detalle->delete();
        
        return redirect()->route('admin.recetas.edit', $receta)
                            ->with('success', 'Componente eliminado exitosamente.');
    }
}
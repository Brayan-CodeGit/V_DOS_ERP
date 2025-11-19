<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\Producto; // Asumo que Receta se relaciona con Producto
// use App\Models\DetalleReceta; // Si lo necesitas más tarde

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recetas = Receta::all();
        return view('admin.recetas.index', compact('recetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Si necesitas una lista de productos finales para la receta
        // $productos = Producto::pluck('Nombre', 'ID_Producto');
        return view('admin.recetas.create'); // , compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Receta' => 'required|string|unique:recetas,Nombre_Receta|max:255',
            'ID_Producto_Final' => 'required|exists:productos,ID_Producto', // Asumiendo que es FK
            'Rendimiento' => 'required|numeric|min:0',
            'Unidad_Rendimiento' => 'required|string|max:10',
        ]);

        Receta::create($request->all());

        return redirect()->route('admin.recetas.index')
                         ->with('success', 'Receta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        // Muestra detalles, ingredientes, etc.
        return view('admin.recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receta $receta)
    {
        // Carga la relación 'detalles' antes de pasarla a la vista
    $receta->load('detalles'); 
    
    // Si también necesitas cargar la relación 'componente' dentro de 'detalles' (para el nombre del producto)
    // usa: $receta->load('detalles.componente');

    // También carga los productos que pueden ser componentes (MP y SE) para el SELECT
    $componentes = Producto::whereIn('Tipo_Producto', ['MP', 'SE'])->get();
    
    return view('admin.recetas.edit', compact('receta', 'componentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta)
    {
        $request->validate([
            // La clave: Ignorar el registro actual en la validación 'unique'
            'Nombre_Receta' => 'required|string|unique:recetas,Nombre_Receta,' . $receta->ID_Receta . ',ID_Receta|max:255',
            'ID_Producto_Final' => 'required|exists:productos,ID_Producto',
            'Rendimiento' => 'required|numeric|min:0',
            'Unidad_Rendimiento' => 'required|string|max:10',
        ]);

        $receta->update($request->all());

        return redirect()->route('admin.recetas.index')
                         ->with('success', 'Receta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receta $receta)
    {
        // Nota: En un sistema real, primero debes eliminar (o desvincular) 
        // los registros en la tabla 'detalle_receta' antes de eliminar la receta.
        
        $receta->delete();

        return redirect()->route('admin.recetas.index')
                         ->with('success', 'Receta eliminada exitosamente.');
    }
}
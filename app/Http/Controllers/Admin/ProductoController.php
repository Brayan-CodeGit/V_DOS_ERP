<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Las opciones de tipo de producto para el dropdown
        $tipos = ['Materia Prima', 'Semielaborado', 'Producto Final', 'Suministro'];
        return view('admin.productos.create', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Codigo_SKU' => 'required|string|unique:productos,Codigo_SKU|max:50',
            'Tipo_Producto' => 'required|in:Materia Prima,Semielaborado,Producto Final,Suministro',
            'Unidad_Medida' => 'required|string|max:10',
            'Costo_Estandar' => 'nullable|numeric|min:0',
            'Es_Inventariable' => 'nullable',
        ]);

        // 2. Preparar los datos y forzar el valor booleano
    $data = $request->all();
    
    // Si el checkbox está marcado, el valor es 'on' o true. Si no viene, es false.
    // Usamos el método has() para verificar si el campo fue enviado.
    $data['Es_Inventariable'] = $request->has('Es_Inventariable'); 

    Producto::create($data); // Usamos $data en lugar de $request->all()

    return redirect()->route('admin.productos.index')
                     ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $tipos = ['Materia Prima', 'Semielaborado', 'Producto Final', 'Suministro'];
        return view('admin.productos.edit', compact('producto', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            // El SKU debe ser único, pero ignorando el SKU del producto actual.
            'Codigo_SKU' => 'required|string|unique:productos,Codigo_SKU,' . $producto->ID_Producto . ',ID_Producto|max:50',
            'Tipo_Producto' => 'required|in:Materia Prima,Semielaborado,Producto Final,Suministro',
            'Unidad_Medida' => 'required|string|max:10',
            'Costo_Estandar' => 'nullable|numeric|min:0',
            'Es_Inventariable' => 'nullable|booleano',
        ]);
        
        $data = $request->except(['_token', '_method']); 

    // Forzar el valor booleano antes de actualizar
    $data['Es_Inventariable'] = $request->has('Es_Inventariable'); 

    $producto->update($data);

    return redirect()->route('admin.productos.index')
                     ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        // 1. ELIMINAR REGISTROS HIJOS PRIMERO:
    // Se usa la relación 'seConsumeEnRecetas' definida en el modelo Producto
    $producto->seConsumeEnRecetas()->delete(); 

    // 2. Ahora, elimina el producto padre. Ya no hay referencias que fallen.
    $producto->delete(); 

    return redirect()->route('admin.productos.index')
                     ->with('success', 'Producto y sus referencias eliminados.');
    }
}

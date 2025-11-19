<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Almacen;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $almacenes = Almacen::all();
        return view('admin.almacenes.index', compact('almacenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.almacenes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Almacen' => 'required|string|unique:almacenes,Nombre_Almacen|max:100',
            'Direccion' => 'nullable|string|max:255',
        ]);

        Almacen::create($request->all());

        return redirect()->route('admin.almacenes.index')
                         ->with('success', 'Almacén creado exitosamente.');
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
    public function edit(Almacen $almacen)
    {
        return view('admin.almacenes.edit', compact('almacen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Almacen $almacen)
    {
        $request->validate([
            // Nombre debe ser único, excluyendo el nombre del almacén actual
            'Nombre_Almacen' => 'required|string|unique:almacenes,Nombre_Almacen,' . $almacen->ID_Almacen . ',ID_Almacen|max:100',
            'Direccion' => 'nullable|string|max:255',
        ]);

        $almacen->update($request->all());

        return redirect()->route('admin.almacenes.index')
                         ->with('success', 'Almacén actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Almacen $almacen)
    {
        // Nota: Asegúrate de que no haya inventario asociado antes de eliminar en un sistema real.
        $almacen->delete();

        return redirect()->route('admin.almacenes.index')
                         ->with('success', 'Almacén eliminado exitosamente.');
    }
}

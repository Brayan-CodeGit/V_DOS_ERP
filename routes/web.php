<?php

use App\Http\Controllers\Admin\AlmacenController;
use App\Http\Controllers\Admin\DetalleRecetaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\RecetaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:administration'])->prefix('admin')->group(function () {
    // 1. Mostrar el formulario para crear un nuevo usuario

    Route::resource('users', UserController::class)->names('admin.users');
    /* Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    
    // 2. Procesar la creación del nuevo usuario y asignación de rol
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    
    // (Opcional) Listar y gestionar usuarios
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index'); */

    // 5. EDIT (Mostrar formulario de edición) <-- ¡FALTA ESTA!
    /* Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    
    // 6. UPDATE (Procesar la actualización) <-- ¡FALTA ESTA!
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    
    // 7. DELETE (Eliminar un usuario) <-- ¡FALTA ESTA!
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy'); */

    Route::resource('productos', ProductoController::class)->names('admin.productos');
    /* Route::resource('almacenes', AlmacenController::class)->names('admin.almacenes')
    ->parameters(['almacenes' => 'ID_Almacen']); */
    Route::resource('almacenes', AlmacenController::class)
        ->names('admin.almacenes')
        // 1. Esto asegura que el parámetro esperado por la ruta se llame 'almacen' (singular del recurso)
        //    y no trate de usar ID_Almacen en la URI.
        ->parameters([
            'almacenes' => 'almacen', 
        ]);
        // 2. Esto le dice al Route Model Binding que use la clave 'ID_Almacen' para la búsqueda.
        /* ->bindingFields([
            'almacen' => 'ID_Almacen'
        ]); */

        Route::resource('recetas', RecetaController::class)
        ->names('admin.recetas');   
        Route::resource('recetas', RecetaController::class)->names('admin.recetas');

    // ➡️ CRUD de DETALLE_RECETA (ANIDADO)
    // El URI será: /admin/recetas/{receta}/detalles
    Route::resource('recetas.detalles', DetalleRecetaController::class)
        ->names('admin.recetas.detalles')
        ->except(['index', 'show', 'create']);
});

require __DIR__.'/auth.php';

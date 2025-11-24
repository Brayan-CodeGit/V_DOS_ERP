<?php

use App\Http\Controllers\Admin\AlmacenController;
use App\Http\Controllers\Admin\DetalleRecetaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\RecetaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil del usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grupo Admin
Route::middleware(['auth', 'role:administration'])->prefix('admin')->name('admin.')->group(function () {

    // Usuarios
    Route::resource('users', UserController::class)
        ->names('users');

    // Productos
    Route::resource('productos', ProductoController::class)
        ->names('productos');

    // Almacenes
    Route::resource('almacenes', AlmacenController::class)
        ->names('almacenes')
        ->parameters([
            'almacenes' => 'almacen', // Route model binding singular
        ]);

    // Recetas
    Route::resource('recetas', RecetaController::class)
        ->names('recetas');

    // Detalle de Recetas (anidado)
    Route::resource('recetas.detalles', DetalleRecetaController::class)
        ->names('recetas.detalles')
        ->except(['index', 'show', 'create']);

    // Proveedores
    Route::resource('proveedores', ProveedorController::class)
    ->names('proveedores')
    ->parameters(['proveedores' => 'proveedor']);

});

require __DIR__.'/auth.php';

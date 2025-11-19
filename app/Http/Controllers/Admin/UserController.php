<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Importar el modelo User
use Spatie\Permission\Models\Role; // Importar el modelo Role de Spatie
use Illuminate\Support\Facades\Hash; // Importar Hash
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Muestra el formulario de creación (debes crear la vista resources/views/admin/users/create.blade.php)
    public function create()
    {
        // Pasa todos los roles al formulario para que el administrador pueda seleccionarlos
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', compact('roles'));
    }

    // Procesa y guarda el nuevo usuario con el rol asignado
    public function store(Request $request)
    {
        // 1. Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name', // Asegura que el rol exista
        ]);

        // 2. Creación del usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Asignación del rol usando Spatie
        $user->assignRole($request->role);

        return redirect()->route('admin.users.index') // Redirigir a la lista de usuarios (o donde quieras)
                         ->with('success', 'Usuario creado y rol asignado correctamente.');
    }

    // (Opcional) Aquí va el método index para listar usuarios...
    public function index()
    {
        // En un caso real, mostrarías una tabla de usuarios aquí
        /* $users = User::all();
        return view('admin.users.index', compact('users')); */

        $users = User::with('roles')->get(); 
    return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        // 1. Obtener todos los roles disponibles para el dropdown.
        $roles = Role::pluck('name', 'name')->all();

        // 2. Obtener el rol actual del usuario para pre-seleccionar en el formulario.
        // Se usa first() porque asumimos que el usuario solo tiene un rol (para simplificar)
        // Si el usuario puede tener múltiples roles, se usaría pluck().
        $userRole = $user->roles->pluck('name')->first(); 

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, User $user)
    {
        // 1. Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            // El email debe ser único, pero ignorando el email del usuario actual.
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
            'role' => 'required|exists:roles,name',
        ]);

        // 2. Actualizar datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // 3. Sincronizar (Reemplazar) el rol usando Spatie
        // El método syncRoles asegura que solo tenga el rol nuevo.
        $user->syncRoles($request->role); 

        return redirect()->route('admin.users.index')
                         ->with('success', 'Usuario y rol actualizados correctamente.');
    }

    public function destroy(User $user)
    {
        // Medida de seguridad: Evitar que el administrador se elimine a sí mismo
        if (Auth::user()->id == $user->id) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }

        // 1. La eliminación del usuario también eliminará automáticamente 
        //    sus registros asociados en las tablas de Spatie (roles y permisos).
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Usuario eliminado correctamente.');
    }
}

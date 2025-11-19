<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash; 

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Resetear el cache de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Definir y Crear Permisos
        // He agregado permisos específicos para los nuevos roles
        $permissions = [
            'manage_users',       // Administración
            'view_reports',       // Administración, Supervisión
            'create_orders',      // Ventas-Producción
            'manage_inventory',   // Logística, Supervisión
            'edit_own_posts',     // Permiso básico para todos
            'view_dashboard',     // Permiso básico para todos
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        // 3. Crear los Nuevos Roles y Asignar Permisos

        // Rol: Administration (Tiene control total y reportes)
        $adminRole = Role::firstOrCreate(['name' => 'administration']);
        $adminRole->givePermissionTo(Permission::all()); // O control total

        // Rol: Sales-Production (Solo puede crear órdenes y ver el dashboard)
        $salesRole = Role::firstOrCreate(['name' => 'sales-production']);
        $salesRole->givePermissionTo([
            'create_orders',
            'edit_own_posts',
            'view_dashboard',
        ]);

        // Rol: Logistics (Gestiona el inventario)
        $logisticsRole = Role::firstOrCreate(['name' => 'logistics']);
        $logisticsRole->givePermissionTo([
            'manage_inventory',
            'view_dashboard',
        ]);
        
        // Rol: Supervisor (Ve reportes y gestiona inventario)
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);
        $supervisorRole->givePermissionTo([
            'view_reports',
            'manage_inventory',
            'view_dashboard',
        ]);
        
        
        // 4. Crear Usuarios de Prueba y Asignar Roles

        // Usuario Administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@company.com'],
            [
                'name' => 'Admin Central',
                'password' => Hash::make('password'), 
            ]
        );
        $adminUser->assignRole('administration');

        // Usuario de Logística
        $logiUser = User::firstOrCreate(
            ['email' => 'logistics@company.com'],
            [
                'name' => 'Juan Logistica',
                'password' => Hash::make('password'), 
            ]
        );
        $logiUser->assignRole('logistics');

        // Usuario de Ventas (puede tener múltiples roles si es necesario)
        $salesUser = User::firstOrCreate(
            ['email' => 'sales@company.com'],
            [
                'name' => 'Maria Ventas',
                'password' => Hash::make('password'), 
            ]
        );
        $salesUser->assignRole('sales-production');
        // Usuario Supervisor (¡NUEVO!)
        $supervisorUser = User::firstOrCreate(
            ['email' => 'supervisor@company.com'],
            [
                'name' => 'Carlos Supervisor',
                'password' => Hash::make('password'), 
            ]
        );
        $supervisorUser->assignRole('supervisor'); // <-- Asignación del rol
        
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permisos
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'upload csv']);
        Permission::firstOrCreate(['name' => 'assign prospects']);
        Permission::firstOrCreate(['name' => 'view all prospects']);
        Permission::firstOrCreate(['name' => 'manage own prospects']);

        // Roles
         $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
         $salesManager = Role::firstOrCreate(['name' => 'sales-manager']);
         $salesAgent = Role::firstOrCreate(['name' => 'sales-agent']);

        // Asignaciones
        $superAdmin->givePermissionTo(Permission::all());
        $salesManager->givePermissionTo(['upload csv', 'assign prospects', 'view all prospects']);
        $salesAgent->givePermissionTo('manage own prospects');

        // Crear un Super Admin de ejemplo
        $superAdminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]
        );
        $superAdminUser->assignRole($superAdmin);

        // Crear un Test User de ejemplo con email único
        $testUser = User::firstOrCreate(
            ['email' => 'testuser@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]
        );
        $testUser->assignRole($salesAgent);
    }
}
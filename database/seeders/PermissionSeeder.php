<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'editar']);
        Permission::create(['name' => 'crear']);
        Permission::create(['name' => 'eliminar']);
        Permission::create(['name' => 'ver']);
        Permission::create(['name' => 'ver-roles']);
        Permission::create(['name' => 'crear-roles']);
        Permission::create(['name' => 'editar-roles']);
        Permission::create(['name' => 'eliminar-roles']);
        Permission::create(['name' => 'ver-permisos']);
    }
}

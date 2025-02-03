<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create permissions
        Permission::create(['name' => 'add certificates']);
        Permission::create(['name' => 'add clients']);
        Permission::create(['name' => 'verify certificates']);
        Permission::create(['name' => 'verify clients']);
        Permission::create(['name' => 'modify users']);
        Permission::create(['name' => 'modify admins']);

        // Create roles and assign permissions
        $support = Role::create(['name' => 'support']);
        $support->givePermissionTo(['add certificates', 'add clients']);

        $developer = Role::create(['name' => 'developer']);
        $developer->givePermissionTo(['add certificates', 'add clients', 'verify certificates', 'verify clients']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['add certificates', 'add clients', 'verify certificates', 'verify clients', 'modify users']);

        $superAdmin = Role::create(['name' => 'superAdmin']);
        $superAdmin->givePermissionTo(['add certificates', 'add clients', 'verify certificates', 'verify clients', 'modify users', 'modify admins']);
    }
}

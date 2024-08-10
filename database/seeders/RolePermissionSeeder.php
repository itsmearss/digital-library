<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-book']);
        Permission::create(['name' => 'read-book']);
        Permission::create(['name' => 'update-book']);
        Permission::create(['name' => 'delete-book']);

        Permission::create(['name' => 'create-category']);
        Permission::create(['name' => 'read-category']);
        Permission::create(['name' => 'update-category']);
        Permission::create(['name' => 'delete-category']);

        Permission::create(['name' => 'create-own-book']);
        Permission::create(['name' => 'read-own-book']);
        Permission::create(['name' => 'update-own-book']);
        Permission::create(['name' => 'delete-own-book']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo([
            'create-book',
            'read-book',
            'update-book',
            'delete-book',
            'create-category',
            'read-category',
            'update-category',
            'delete-category',
        ]);

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo([
            'create-own-book',
            'read-own-book',
            'update-own-book',
            'delete-own-book',
        ]);
    }
}

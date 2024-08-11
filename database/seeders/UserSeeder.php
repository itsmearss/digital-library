<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@detik.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');

        $penulis = User::create([
            'name' => 'User',
            'email' => 'user@detik.com',
            'password' => Hash::make('password'),
        ]);

        $penulis->assignRole('user');
    }
}

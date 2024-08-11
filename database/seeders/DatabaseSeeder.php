<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //
        Category::create(['name' => 'Fiksi']);
        Category::create(['name' => 'Non-Fiksi']);
        Category::create(['name' => 'Fantasi']);
        Category::create(['name' => 'Thriller']);
        Category::create(['name' => 'Pengembangan Diri']);
    }
}

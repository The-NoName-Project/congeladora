<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Rol;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Rol::create([
            'name' => 'Administrador'
        ]);

        Rol::create([
            'name' => 'Arbitro'
        ]);

        Rol::create([
            'name' => 'Capitan'
        ]);

        Rol::create([
            'name' => 'Jugador'
        ]);

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@canchas.com',
            'password' => Hash::make('12345678'),
            'phone' => '5532312815',
            'rol_id' => 1,
        ]);

        Category::create([
            'name' => 'Varonil'
        ]);

        Category::create([
            'name' => 'Femenil'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        // Crear roles si no existen
        if (DB::table('rols')->count() == 0) {
            DB::table('rols')->insert([
                ['name' => 'ROLE_USER'],
                ['name' => 'ROLE_ADMIN'],
            ]);
        }

        if (!User::where('username', 'usuario')->exists()) {
            User::create([
                'name'        => 'Juan',
                'apellidoUno' => 'Perez',
                'apellidoDos' => 'Lopez',
                'email'       => 'usuario@gmail.com',
                'telefono'    => '88888888',
                'username'    => 'usuario',
                'password'    => Hash::make('1234'),
                'rol_id'      => 1,
            ]);
        }

        if (!User::where('username', 'admin')->exists()) {
            User::create([
                'name'        => 'Admin',
                'apellidoUno' => 'Principal',
                'apellidoDos' => 'Sistema',
                'email'       => 'admin@gmail.com',
                'telefono'    => '99999999',
                'username'    => 'admin',
                'password'    => Hash::make('1234'),
                'rol_id'      => 2,
            ]);
        }
    }
}

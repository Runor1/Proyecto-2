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
                ['nombre' => 'ROLE_USER'],
                ['nombre' => 'ROLE_ADMIN'],
            ]);
        }

        if (!User::where('userName', 'usuario')->exists()) {
            User::create([
                'name'        => 'Juan',
                'apellidoUno' => 'Perez',
                'apellidoDos' => 'Lopez',
                'email'       => 'usuario@gmail.com',
                'telefono'    => '88888888',
                'userName'    => 'usuario',
                'password'    => Hash::make('1234'),
                'rol_id'      => 1,
            ]);
        }

        if (!User::where('userName', 'admin')->exists()) {
            User::create([
                'name'        => 'Admin',
                'apellidoUno' => 'Principal',
                'apellidoDos' => 'Sistema',
                'email'       => 'admin@gmail.com',
                'telefono'    => '99999999',
                'userName'    => 'admin',
                'password'    => Hash::make('1234'),
                'rol_id'      => 2,
            ]);
        }
    }
}

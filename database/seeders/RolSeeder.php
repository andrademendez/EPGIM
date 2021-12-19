<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Administrador con permiso de todo el sistema',
            ],
            [
                'nombre' => 'Creador',
                'descripcion' => 'Acceso medio al sistema',
            ],
            [
                'nombre' => 'Monitor',
                'descripcion' => 'Acceso a tablero del sistema',
            ],
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ciudades')->insert([
            [
                'clave' => '005',
                'nombre' => 'Anáhuac',
            ],
            [
                'clave' => '006',
                'nombre' => 'Apodaca',
            ],
            [
                'clave' => '018',
                'nombre' => 'García',
            ],
            [
                'clave' => '019',
                'nombre' => 'San Pedro Garza García',
            ],
            [
                'clave' => '021',
                'nombre' => 'General Escobedo',
            ],
            [
                'clave' => '026',
                'nombre' => 'Guadalupe',
            ],
            [
                'clave' => '031',
                'nombre' => 'Juárez',
            ],
            [
                'clave' => '039',
                'nombre' => 'Monterrey',
            ],
            [
                'clave' => '041',
                'nombre' => 'Pesquería',
            ],
            [
                'clave' => '045',
                'nombre' => 'Salinas Victoria',
            ],
            [
                'clave' => '046',
                'nombre' => 'San Nicolás de los Garza',
            ],
            [
                'clave' => '048',
                'nombre' => 'Santa Catarinaa',
            ],
            [
                'clave' => '049',
                'nombre' => 'Santiago',
            ],
        ]);
    }
}
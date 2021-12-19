<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEspaciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipos_espacios')->insert([
            [
                'nombre' => 'Activación',
            ],
            [
                'nombre' => 'Banners Aereos',
            ],
        ]);
    }
}
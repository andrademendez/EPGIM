<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicaciones_espacios')->insert([
            [
                'nombre' => 'Interior',
                'created_at' => now(),
            ],
            [
                'nombre' => 'Exterior',
                'created_at' => now(),
            ],
        ]);
    }
}
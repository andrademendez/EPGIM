<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Jose Andrade Méndez',
            'email' => 'jandrade@delking.mx',
            'password' => Hash::make('A1234567'),
            'id_rol' => 1,
        ]);
    }
}
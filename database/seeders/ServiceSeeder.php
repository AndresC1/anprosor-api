<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Limpieza',
                'description' => 'Limpieza de granos',
            ],
            [
                'name' => 'Almacenamiento',
                'description' => 'Almacenamiento de granos',
            ],
            [
                'name' => 'Secado',
                'description' => 'Secado de granos',
            ],
            [
                'name' => 'Fumigación',
                'description' => 'Fumigación de granos',
            ]
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('services')->truncate();
        DB::table('services')->insert($services);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

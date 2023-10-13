<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ['name' => 'admin', 'description' => 'Administrador'],
            ['name' => 'analista', 'description' => 'Analista'],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('roles')->insert($role);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

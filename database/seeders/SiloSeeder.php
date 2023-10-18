<?php

namespace Database\Seeders;

use Database\Factories\SiloFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('silos')->truncate();
        SiloFactory::new()->count(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

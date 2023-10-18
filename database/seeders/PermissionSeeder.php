<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'add_user', 'description' => 'Permiso para agregar usuarios'],
            ['name' => 'view_list_user', 'description' => 'Permiso para ver lista de usuarios'],
            ['name' => 'add_grain', 'description' => 'Permiso para ver y agregar granos'],
            ['name' => 'edit_grain', 'description' => 'Permiso para editar granos'],
            ['name' => 'delete_grain', 'description' => 'Permiso para eliminar granos'],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert($permissions);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

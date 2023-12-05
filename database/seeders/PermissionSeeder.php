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
            ['name' => 'add_grain', 'description' => 'Permiso para agregar granos'],
            ['name' => 'edit_grain', 'description' => 'Permiso para editar granos'],
            ['name' => 'delete_grain', 'description' => 'Permiso para eliminar granos'],
            ['name' => 'add_silo', 'description' => 'Permiso para ver y agregar silos'],
            ['name' => 'edit_silo', 'description' => 'Permiso para editar silos'],
            ['name' => 'delete_silo', 'description' => 'Permiso para eliminar silos'],
            ['name' => 'add_service', 'description' => 'Permiso para ver y agregar servicios'],
            ['name' => 'edit_service', 'description' => 'Permiso para editar servicios'],
            ['name' => 'delete_service', 'description' => 'Permiso para eliminar servicios'],
            ['name' => 'add_client', 'description' => 'Permiso para ver y agregar clientes'],
            ['name' => 'edit_client', 'description' => 'Permiso para editar clientes'],
            ['name' => 'delete_client', 'description' => 'Permiso para eliminar clientes'],
            ['name' => 'show_grain', 'description' => 'Permiso para ver lista granos'],
            ['name' => 'show_silo', 'description' => 'Permiso para ver lista de silos'],
            ['name' => 'show_service', 'description' => 'Permiso para ver lista de servicios'],
            ['name' => 'show_client', 'description' => 'Permiso para ver lista de clientes'],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert($permissions);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolePermission = [
            ['role_id' => 1, 'permission_id' => 1],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_permissions')->truncate();
        DB::table('role_permissions')->insert($rolePermission);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

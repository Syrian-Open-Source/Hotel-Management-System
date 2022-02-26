<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-show',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-show',
            'user-edit',
            'user-delete',
            ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api', 'name' => $permission]);
        }

    }
}

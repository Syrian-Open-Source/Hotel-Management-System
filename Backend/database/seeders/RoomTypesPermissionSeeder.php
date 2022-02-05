<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoomTypesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'room-type-list',
            'room-type-create',
            'room-type-show',
            'room-type-edit',
            'room-type-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api','name' => $permission]);
        }
    }
}

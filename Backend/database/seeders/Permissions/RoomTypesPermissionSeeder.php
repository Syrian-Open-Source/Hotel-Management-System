<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            Permission::create(['name' => $permission]);
        }
    }
}

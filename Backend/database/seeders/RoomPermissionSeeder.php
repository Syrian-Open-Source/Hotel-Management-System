<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoomPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'room-list',
            'room-create',
            'room-show',
            'room-edit',
            'room-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name'=>'api','name' => $permission]);
        }

    }
}

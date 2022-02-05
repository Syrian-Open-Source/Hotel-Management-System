<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class BookingPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'booking-list',
            'booking-create',
            'booking-show',
            'booking-edit',
            'booking-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api','name' => $permission]);
        }

    }
}

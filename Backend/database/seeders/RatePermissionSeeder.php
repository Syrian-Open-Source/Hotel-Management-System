<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'rate-list',
            'rate-create',
            'rate-show',
            'rate-edit',
            'rate-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api','name' => $permission]);
        }

    }
}

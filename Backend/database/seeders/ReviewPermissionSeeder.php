<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ReviewPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'review-list',
            'review-create',
            'review-show',
            'review-edit',
            'review-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api','name' => $permission]);
        }
    }
}

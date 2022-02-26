<?php

namespace Database\Seeders;
use  Database\Seeders\PermissionSeeder;
use  Database\Seeders\CreateSuperAdminUserSeeder;
use  Database\Seeders\RoomTypesPermissionSeeder;
use  Database\Seeders\RoomPermissionSeeder;
use  Database\Seeders\BookingPermissionSeeder;
use  Database\Seeders\ReviewPermissionSeeder;
use  Database\Seeders\RatePermissionSeeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StaffSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoomTypesPermissionSeeder::class);
        $this->call(RoomPermissionSeeder::class);
        $this->call(BookingPermissionSeeder::class);
        $this->call(ReviewPermissionSeeder::class);
        $this->call(RatePermissionSeeder::class);
        $this->call(CreateSuperAdminUserSeeder::class);
    }
}

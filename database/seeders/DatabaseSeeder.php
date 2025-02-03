<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run roles and permissions seeder first
        $this->call(RolesAndPermissionsSeeder::class);

        // Run test users seeder
        $this->call(TestUsersSeeder::class);

        // Run certificate and client seeder
        $this->call(CertificateSeeder::class);
        $this->call(ClientSeeder::class);
    }
}

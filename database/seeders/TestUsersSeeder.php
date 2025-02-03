<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeding admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@tg-devportal.com'], // Ensure unique admin
            [
                'name' => 'John Doe',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'adminpassword')), // Use ENV variable
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'password_set' => true
            ]
        );

        // Seeding developer
        $developer = User::updateOrCreate(
            ['email' => 'developer@tg-devportal.com'], // Ensure unique developer
            [
                'name' => 'John Smith',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make(env('DEVELOPER_PASSWORD', 'developerpassword')), // Use ENV variable
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'password_set' => true
            ]
        );

        // Seeding support
        $support = User::updateOrCreate(
            ['email' => 'support@tg-devportal.com'], // Ensure unique support
            [
                'name' => 'Jane Richards',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make(env('SUPPORT_PASSWORD', 'supportpassword')), // Use ENV variable
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'password_set' => true
            ]
        );

        // Assign roles with laravel-permissions package
        $admin->assignRole('admin');
        $developer->assignRole('developer');
        $support->assignRole('support');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        Certificate::factory(50)->create();


        // Expiring soon certificates
        Certificate::factory(28)->create([
            'expiry_date' => Carbon::now()->addDays(30),
            'status' => 'active'
        ]);
    }
}

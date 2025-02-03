<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Certificate;
use Illuminate\Support\Carbon;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CertificateTest extends TestCase
{
    use RefreshDatabase;
    private $support;
    private $developer;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the roles and permissions
        $this->seed(RolesAndPermissionsSeeder::class);

        // Create developer
        $this->developer = User::factory()->create([
            'password_set' => true
        ]);
        $this->developer->assignRole('developer');

        // Create support
        $this->support = User::factory()->create([
            'password_set' => true
        ]);
        $this->support->assignRole('support');
    }

    public function test_cert_status_is_active()
    {

        $expiry_date = Carbon::now()->addDecade();
        $attributes = [
            'common_name' => 'example.com',
            'country' => 'MY',
            'organization' => 'Let\'s Encrypt',
            'expiry_date' => $expiry_date,
        ];

        $response = $this->actingAs($this->support)->post('/certificates', $attributes);
        $response->assertStatus(201);
        $this->assertDatabaseHas('certificates', [
            'status' => 'active'
        ]);
    }

    public function test_cert_status_is_revoked()
    {

        $expiry_date = Carbon::now()->subDecade();
        $attributes = [
            'common_name' => 'example.com',
            'country' => 'MY',
            'organization' => 'Let\'s Encrypt',
            'expiry_date' => $expiry_date,
        ];

        $response = $this->actingAs($this->support)->post('/certificates', $attributes);

        $this->assertDatabaseHas('certificates', [
            'status' => 'revoked'
        ]);
    }

    public function test_developer_can_open_verify_cert_page()
    {
        $cert = Certificate::factory()->create();


        $response = $this->actingAs($this->developer)->get('/certificates/' . $cert->id);

        $response->assertViewIs('cert.update');
        $response->assertViewHas('cert', $cert);
    }

    public function test_developer_can_update_and_verify_cert()
    {
        $cert = Certificate::factory()->create();
        $expiry_date = Carbon::now()->addDecade();

        $attributes = [
            'id' => $cert->id,
            'common_name' => 'example.com',
            'country' => 'MY',
            'organization' => 'Let\'s Encrypt',
            'expiry_date' => $expiry_date,
        ];

        $response = $this->actingAs($this->developer)->patch('/certificates', $attributes);
        $response->assertRedirect(route('certificates'));

        $this->assertDatabaseHas('certificates', [
            'id' => $cert->id,
            'common_name' => 'example.com',
            'country' => 'MY',
            'organization' => 'Let\'s Encrypt',
            'expiry_date' => $expiry_date,
            'status' => 'active',
            'verified' => true,
        ]);
    }

    public function test_support_cannot_update_and_verify_cert()
    {
        $cert = Certificate::factory()->create();
        $expiry_date = Carbon::now()->addDecade();

        $attributes = [
            'id' => $cert->id,
            'common_name' => 'example.com',
            'country' => 'MY',
            'organization' => 'Let\'s Encrypt',
            'expiry_date' => $expiry_date,
        ];

        $response = $this->actingAs($this->support)->patch('/certificates', $attributes);
        $response->assertForbidden();
    }
}

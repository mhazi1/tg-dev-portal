<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
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

    public function test_support_can_add_new_client()
    {
        $attributes = [
            'name' => 'Abu bin Ali',
            'role' => 'Developer',
            'company' => 'TG Solutions Bhd',
        ];

        $response = $this->actingAs($this->support)->post('/clients', $attributes);
        $response->assertStatus(201);
        $this->assertDatabaseHas('clients', $attributes);
    }

    public function test_developer_can_open_verify_client_page()
    {
        $client = Client::factory()->create();


        $response = $this->actingAs($this->developer)->get('/clients/' . $client->id);

        $response->assertViewIs('client.update');
        $response->assertViewHas('client', $client);
    }

    public function test_developer_can_update_and_verify_client()
    {
        $client = Client::factory()->create();


        $attributes = [
            'id' => $client->id,
            'name' => 'Amirul',
            'role' => 'PHP Developer',
            'company' => 'Microsoft',
        ];

        $response = $this->actingAs($this->developer)->patch('/clients', $attributes);
        $response->assertRedirect(route('clients'));

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Amirul',
            'role' => 'PHP Developer',
            'company' => 'Microsoft',
            'verified' => true,
        ]);
    }

    public function test_support_cannot_update_and_verify_client()
    {
        $client = Client::factory()->create();


        $attributes = [
            'id' => $client->id,
            'name' => 'Amirul',
            'role' => 'PHP Developer',
            'company' => 'Microsoft',
        ];

        $response = $this->actingAs($this->support)->patch('/clients', $attributes);
        $response->assertForbidden();
    }
}

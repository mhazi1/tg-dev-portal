<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\User;
use App\Models\Certificate;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class SessionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the roles and permissions
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_login_successful()
    {
        // Arrange
        $plainPassword = 'password';
        $user = User::factory()->create([
            'password' => bcrypt($plainPassword),
            'password_set' => true
        ]);
        $user->assignRole('developer');

        $attributes = ['email' => $user->email, 'password' => $plainPassword];

        // Assert
        $response = $this->post('/login', $attributes);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }

    public function test_login_failed()
    {

        // Asset
        $attributes = ['email' => 'email@gmail.com', 'password' => 'password'];

        $response = $this->post('/login', $attributes);

        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect();
    }

    public function test_logout_successful()
    {
        $plainPassword = 'password';
        $user = User::factory()->create(['password' => bcrypt($plainPassword)]);

        // Explicitly login the user
        $this->actingAs($user);

        // Perform logout with full request context
        $response = $this->delete(route('logout'));

        // Check authentication status
        $this->assertGuest();

        // Assert redirection after logout
        $response->assertRedirect('/login');
    }

    public function test_can_open_dashboard()
    {
        $user = User::factory()->create([
            'password_set' => true
        ]);

        // Create test data for assertions
        Certificate::factory()->count(20)->create([
            'expiry_date' => Carbon::now()->addYear(),
            'status' => 'active'
        ]);
        Certificate::factory()->count(15)->create([
            'expiry_date' => Carbon::now()->addDays(30),
            'status' => 'active'
        ]);
        Client::factory()->count(2)->create([
            'verified' => true
        ]);

        $this->actingAs($user);
        $response = $this->get(route('dashboard'));

        // Assertions
        $response->assertOk();
        $response->assertViewIs('index');

        $this->assertEquals(2, Client::count());
        $this->assertEquals(2, Client::where('verified', true)->count());

        // Assert that the correct data is passed to the view
        $response->assertViewHas('activeCertificates', 35); // Should match the count
        $response->assertViewHas('expiringSoon', 15); // Should match expiring certificates
        $response->assertViewHas('verifiedClients', 2); // Should match client count

        // Assert that the values are visible on the page
        $response->assertSee('35'); // Active Certificates
        $response->assertSee('15'); // Expiring in 30 Days
        $response->assertSee('2'); // Verified Clients
    }
}

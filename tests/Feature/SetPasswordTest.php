<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\NewUserVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SetPasswordTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the roles and permissions
        $this->seed(RolesAndPermissionsSeeder::class);

        // Create admin user
        $this->admin = User::factory()->create([
            'password_set' => true
        ]);
        $this->admin->assignRole('admin');
    }

    public function test_admin_can_register_new_user()
    {
        Mail::fake();

        $response = $this->actingAs($this->admin)->post(route('store-user'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'developer'
        ]);

        // Assert response
        $response->assertRedirect(route('users'));


        // Assert user was created
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password_set' => false,
            'email_verified_at' => null
        ]);

        // Assert role was assigned
        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue($user->hasRole('developer'));

        // Assert email was sent
        Mail::assertSent(NewUserVerification::class, function ($mail) {
            return $mail->hasTo('test@example.com');
        });
    }

    public function test_user_can_set_password_with_valid_token()
    {
        // Create unverified user
        $user = User::factory()->create([
            'password' => null,
            'password_set' => false,
            'email_verified_at' => null
        ]);


        // Use Password::createToken instead of manual token creation
        $token = Password::createToken(
            $user
        );

        $response = $this->post(route('store-password'), [
            'email' => $user->email,
            'token' => $token,
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        // Add these debug lines
        // dd([
        //     'status' => $response->status(),
        //     'session' => session()->all(),
        //     'user_before_refresh' => $user->toArray(),
        //     'user_after_refresh' => $user->fresh()->toArray(),
        //     'password_reset_tokens' => DB::table('password_reset_tokens')->where('email', $user->email)->first()
        // ]);

        // Assert response
        $response->assertRedirect(route('login'));

        // Refresh user from database
        $user->refresh();

        // Assert user is now verified
        $this->assertNotNull($user->email_verified_at);
        $this->assertNotNull($user->password);
        $this->assertTrue($user->password_set);
    }

    public function test_cannot_set_password_with_invalid_token()
    {
        $user = User::factory()->create([
            'password' => null,
            'password_set' => false,
            'email_verified_at' => null
        ]);

        $response = $this->post(route('store-password'), [
            'email' => $user->email,
            'token' => 'invalid-token',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        // dd([
        //     'status' => $response->status(),
        //     'session' => session()->all(),
        //     'user_before_refresh' => $user->toArray(),
        //     'user_after_refresh' => $user->fresh()->toArray(),
        //     'password_reset_tokens' => DB::table('password_reset_tokens')->where('email', $user->email)->first()
        // ]);

        $response->assertSessionHasErrors('email');

        // Refresh user from database
        $user->refresh();

        // Assert user is still unverified
        $this->assertFalse($user->password_set);
        $this->assertNull($user->email_verified_at);
    }
}

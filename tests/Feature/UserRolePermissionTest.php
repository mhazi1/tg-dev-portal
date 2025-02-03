<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class UserRolePermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the roles and permissions
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_support_can_add_certs()
    {
        // Arrange
        $userSupport = User::factory()->create([
            'password_set' => true
        ]);
        $userSupport->assignRole('support');
        $expiry_date = Carbon::now()->addDecade();
        $attributes = [
            'common_name' => 'example.com',
            'country' => 'MY',
            'organization' => 'Let\'s Encrypt',
            'expiry_date' => $expiry_date,
        ];

        $response = $this->actingAs($userSupport)->post('/certificates', $attributes);
        $response->assertStatus(201);
        $this->assertDatabaseHas('certificates', $attributes);
    }


    public function test_can_open_modify_user_page()
    {
        $user = User::factory()->create([
            'password_set' => true
        ]);
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get(route('get-user', $user->id));

        $response->assertViewIs('auth.update');
        $response->assertViewHas('user', $user);
    }

    public function test_admin_can_open_users_index_page()
    {
        $admin = User::factory()->create([
            'password_set' => true
        ]);
        $admin->assignRole('admin');
        $users = User::factory(10)->create([
            'password_set' => true
        ])->each(function ($user) {
            $user->assignRole(fake()->randomElement(['support', 'developer']));
        });


        $response = $this->actingAs($admin)->get(route('users'));

        $response->assertOk();
        $response->assertViewIs('auth.index');

        // Paginate users for comparison
        $paginatedUsers = User::latest()->paginate(10);

        // Assert that the view has users and they match
        $response->assertViewHas('users', function ($viewUsers) use ($paginatedUsers) {
            return $viewUsers->count() === $paginatedUsers->count() &&
                $viewUsers->pluck('id')->diff($paginatedUsers->pluck('id'))->isEmpty();
        });
    }

    public function test_others_cannot_open_users_index_page()
    {
        $developer = User::factory()->create([
            'password_set' => true
        ]);
        $developer->assignRole('developer');

        $response = $this->actingAs($developer)->get(route('users'));

        $response->assertForbidden();
    }

    public function test_admin_can_delete_user()
    {
        $admin = User::factory()->create([
            'password_set' => true
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'password_set' => true
        ]);
        $user->assignRole('support');

        $this->assertDatabaseHas('users', ['id' => $user->id]);

        $response = $this->actingAs($admin)->delete(route('delete-user'), ['id' => $user->id]);

        $response->assertRedirect(route('users'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_others_cannot_delete_users()
    {
        $developer = User::factory()->create([
            'password_set' => true
        ]);
        $developer->assignRole('developer');

        $user = User::factory()->create([
            'password_set' => true
        ]);
        $user->assignRole('support');

        $response = $this->actingAs($developer)->delete(route('delete-user'), ['id' => $user->id]);

        $response->assertForbidden();
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $roleAdmin = Role::create(['name' => 'admin']);
        Role::create(['name' => 'client']);

        $this->admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
        ]);
        $this->admin->assignRole($roleAdmin);

        $this->actingAs($this->admin);
    }

    public function test_can_display_a_list_of_users(): void
    {
        // создаем несколько пользователей с ролью client
        $users = User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                $user->assignRole('client');
            });
        // get-запрос по маршруту /users
        $response = $this->get('/users?role[]=client');
        $response->assertStatus(200);

        // проверяем, что все клиенты отображаются и в список не попали админы
        foreach ($users as $user) {
            $response->assertSee($user->name);

            $this->assertTrue($user->hasRole('client'));
            $this->assertFalse($user->hasRole('admin'));
        }
    }

    public function test_can_display_the_edit_user_form(): void
    {
        $user = User::factory()->create();
        $response = $this->get(route('users.edit', $user));

        $response->assertStatus(200);
        $response->assertSee('Account settings - Account');
        $response->assertSee($user->name);
    }

    public function test_can_update_a_user(): void
    {
        $user = User::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'last_name' => 'Updated Last Name',
            'email' => 'updated@email.com',
            'phone' => '192371923719',

        ];

        $response = $this->put(route('users.update', $user), $updateData);
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('users', $updateData);
    }

    public function test_validates_update_request(): void
    {
        $user = User::factory()->create();

        $response = $this->put(route('users.update', $user), [
            'name' => '',
            'last_name' => '',
            'email' => '',
            'phone' => '12345',
        ]);

        $response->assertSessionHasErrors(['name', 'last_name', 'email', 'phone']);
    }

    public function test_validates_email_update_request(): void
    {
        $user = User::factory()->create();
        $response = $this->put(route('users.update', $user), [
            'email' => 'admin@app.com',
        ]);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_returns_404_if_user_not_found(): void
    {
        $nonExistingUserId = 9999;

        $response = $this->put(route('users.update', $nonExistingUserId), []);
        $response->assertStatus(404);

        $response = $this->get(route('users.edit', $nonExistingUserId));
        $response->assertStatus(404);

        $response = $this->delete(route('users.destroy', $nonExistingUserId));
        $response->assertStatus(404);
    }

    public function test_can_delete_a_user(): void
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);

    }
}

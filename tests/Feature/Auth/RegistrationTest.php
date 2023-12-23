<?php

namespace Tests\Feature\Auth;

use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $role = $this->createRole('New User');

        $response = $this->post('/register', [
            'name' => 'TestUser',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email_verified_at' => now(),
            'role' => $role->name,
        ]);




        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::WELCOME);
    }

    private function createRole($name)
{
    return \Spatie\Permission\Models\Role::create(['name' => $name]);
}
}

<?php

namespace Tests\Feature\LNU;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LnuTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest_can_visit_lnu_home_page()
    {
        $response = $this->get('/');

        $this->assertGuest();

        $response->assertStatus(200);
    }
    public function test_user_or_admin_can_visit_lnu_home_page()
    {
        $user = User::factory()->create();

        // Log in the user
        $this->actingAs($user);

        // Visit the 'lnu' page
        $response = $this->get(route('lnu'));

        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)
        $response->assertStatus(200);
    }
}

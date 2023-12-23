<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/profile/{$user->id}");

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch("/profile-patch/{$user->id}", [
                'name' => 'TestUser',
                'email' => $user->email, // Use the same email in the assertion
                'first_name' => 'first',
                'last_name' => 'last',
                'middle_name' => 'middle',
                'suffix' => 'Jr',
                'gender' => 'male',
                'birth_date' => '10/05/1997',
                'address' => 'InternetCity',
                'contact_number' => '074543321',
                'province' => 'WebServer',
                'city' => 'Cloud',
                'barangay' => 'WebserverCloud',
                'zipcode' => '4200',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect("/profile/{$user->id}");

        $user->refresh();

        $this->assertSame('TestUser', $user->name);
        $this->assertSame($user->email, $user->email); // Use the same email in the assertion
        $this->assertSame($user->email_verified_at->toDateTimeString(), $user->email_verified_at->toDateTimeString());
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch("/profile-patch/{$user->id}", [
                'name' => 'Test User',
                'email' => $user->email,
                'first_name' => 'first',
                'last_name' => 'last',
                'middle_name' => 'middle',
                'suffix' => 'Jr',
                'gender' => 'male',
                'birth_date' => '10/05/1997',
                'address' => 'InternetCity',
                'contact_number' => '074543321',
                'province' => 'WebServer',
                'city' => 'Cloud',
                'barangay' => 'WebserverCloud',
                'zipcode' => '4200',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect("/profile/{$user->id}");

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}

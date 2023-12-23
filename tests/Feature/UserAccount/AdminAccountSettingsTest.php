<?php

namespace Tests\Feature\UserAccount;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminAccountSettingsTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        // Create the 'admin' role
        Role::create(['name' => 'admin']);

    }

    public function test_admin_account_settings_page_can_be_rendered()
    {

        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Visit the 'lnu' page
        $response = $this->get('/admin/main');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }

    public function test_admin_can_show_user_details()
    {
        // Create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Create a user to be deleted
        $userShow = User::factory()->create();

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Send a delete request to delete the user
        $response = $this->get(route('admin.users.show', ['user' => $userShow->id, 'user_id' => $userShow->id]));

        // Assert that the user is authenticated
        $this->assertAuthenticated();

        $response->assertStatus(200);

    }


    public function test_admin_can_update_user_authorization()
    {
        // Create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Create a user to be updated
        $userToUpdate = User::factory()->create();

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Simulate a request to update the user's authorization
        $response = $this->post(route('toggle.update-user', $userToUpdate->id), [
            'state' => true, // Adjust this based on your actual request structure
        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Refresh the user from the database
        $userToUpdate->refresh();

        // Assert that the user's authorization has been updated
        $this->assertEquals('checked', $userToUpdate->authorize);
    }




    public function test_admin_can_delete_user()
    {
        // Create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Create a user to be deleted
        $userToDelete = User::factory()->create();

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Send a delete request to delete the user
        $response = $this->delete(route('admin.users.destroy', $userToDelete->id));


        // Assert the response is a redirect
        $response->assertRedirect(route('admin.users.main'));

        // Assert that the user has been deleted from the database
        $this->assertDatabaseMissing('users', ['id' => $userToDelete->id]);
    }


}

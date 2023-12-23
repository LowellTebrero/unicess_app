<?php

namespace Tests\Feature\AdminInventory;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\CustomizeAdminInventory;
use Database\Factories\CustomizeAdminInventoryFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminInventoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'admin']);

    }

    public function test_admin_inventory_page_by_files_can_be_rendered()
    {
        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Visit the 'lnu' page
        $response = $this->get('/admin/admin-inventory');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }


    public function test_admin_inventory_page_by_program_can_be_rendered()
    {
        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Visit the 'lnu' page
        $response = $this->get('/admin/admin-inventory');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }

    public function test_admin_can_search_files_in_inventory(){

        // Assuming you have the necessary setup and roles, create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Simulate a request to search for files
        $response = $this->get(route('admin.inventory.admin-search'), [
            'query' => 'your_search_query',
            'selected_value' => 'your_selected_value',
            'files' => 'your_files_value',
        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        // (You need to adapt this based on your actual implementation)
        $response->assertViewIs('admin.inventory.index-filter._all-files-medias');
        $response->assertViewHas('program'); // Assuming 'program' is part of your view data



    }

    public function test_admin_can_filter_files_by_year_in_inventory(){

        // Assuming you have the necessary setup and roles, create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Simulate a request to search for files
        $response = $this->get(route('admin.inventory.admin-filter'), [
            'query' => 'your_search_query',
            'year' => '2023',
            'files' => 'your_files_value',
        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        $response->assertViewIs('admin.inventory.index-filter._all-files-medias');
        $response->assertViewHas('program');

    }

    public function test_admin_can_filter_files_by_type_in_inventory(){

        // Assuming you have the necessary setup and roles, create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Simulate a request to search for files
        $response = $this->get(route('admin.inventory.admin-sort-file'), [
            'selected_value' => 'Proposal',
            'query' => 'proposal_test',
            'year' => '2023',
        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        $response->assertViewIs('admin.inventory.index-filter._all-files-medias');
        $response->assertViewHas('program');

        // Add more assertions based on your specific expectations

   }

    public function test_admin_can_filter_files_by_asc_to_desc_or_desc_to_asc_in_inventory(){

        // Assuming you have the necessary setup and roles, create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Simulate a request to search for files
        $response = $this->get(route('admin.inventory.admin-sort'), [
            'selected_value' => 'asc',
            'year' => '2023',
            'files' => 'Proposal',
            'query' => 'Proposal Test',

        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        // (You need to adapt this based on your actual implementation)
        $response->assertViewIs('admin.inventory.index-filter._all-files-medias');
        $response->assertViewHas('program'); // Assuming 'program' is part of your view data

    }

    public function test_admin_can_filter_files_to_program_using_dropdown()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Create a CustomizeAdminInventory instance with ID 1
        CustomizeAdminInventory::factory()->create();


        // Simulate a request to update the customize settings using the named route
        $response = $this->post(route('update.customize', ['id' => 1]), [
            'selected_value' => 1, // Adjust the value based on your requirements
            '_token' => csrf_token(),
        ]);

        // Assert the response is successful
        $response->assertSuccessful();

    }



}

<?php

namespace Tests\Feature\AdminOtherSetting;

use App\Models\AdminYear;
use App\Models\Faculty;
use Tests\TestCase;
use App\Models\User;
use App\Models\Template;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminOtherSettingTest extends TestCase
{
    use RefreshDatabase;


    public function test_admin_other_settings_page_can_be_rendered()
    {
        Role::create(['name' => 'admin']);

        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        $response = $this->get('/admin/template-index');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }

    public function test_admin_can_update_proposal_template()
    {

        Role::create(['name' => 'admin']);
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Use UploadedFile::fake() to create a fake Word document
        $fakeWordDocument = UploadedFile::fake()->create('Program-and-Project-Proposal-FORMAT.docx', 1);

        $template = Template::create([
            'template_name' => $fakeWordDocument,
        ]);

        $response = $this->put(route('admin.template.update', ['id' => $template->id]), [
            'template_name' => $fakeWordDocument,
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.template.index'));

        // Refresh the template from the database
        $template->refresh();

        // Assert that the template has been updated
        $this->assertSame($fakeWordDocument->getClientOriginalName(), $template->template_name);
    }

    public function test_admin_can_add_year()
    {

        Role::create(['name' => 'admin']);
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        $response = $this->post(route('admin.yearpost.upload'), [
            'year' => 2024,
        ]);

        $this->assertAuthenticated();

        // Check for a redirect status
        $response->assertRedirect(route('admin.template.index'));

        // Assert that the year was added successfully
        $this->assertDatabaseHas('admin_years', ['year' => 2024]);
    }

    public function test_admin_can_upload_faculty_name(){


        Role::create(['name' => 'admin']);
        // Assuming you have a user in your database or use the User factory
        $adminUser = User::factory()->create();

        // Assign either the 'Faculty extensionist,' 'Extension coordinator,' or 'Admin' role
        $adminUser->assignRole(['admin']);

           // Authenticate the user
        $this->actingAs($adminUser);


           // Simulate a POST request with proposal data
        $response = $this->post(route('admin.facultypost.upload'), [
            'name' => 'IT Faculty',

        ]);

        $this->assertAuthenticated();

        // Check for a redirect status
        $response->assertRedirect(route('admin.template.index'));



    }







}

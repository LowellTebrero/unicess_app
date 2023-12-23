<?php

namespace Tests\Feature\Proposal;

use Tests\TestCase;
use App\Models\User;
use App\Models\Program;
use App\Models\Proposal;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProposalTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();

        // Create the 'admin' role
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'Faculty extensionist']);
        Role::create(['name' => 'Extension coordinator']);
    }

    public function test_admin_proposal_page_can_be_rendered()
    {
       // Assuming you have a user with the admin role in your database or use the User factory
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Make the request
        $response = $this->get('/admin/upload');

        // Assert the status
        $response->assertStatus(200);
    }



    public function test_user_proposal_page_can_be_rendered()
    {
        // Assuming you have a user in your database or use the User factory
        $user = User::factory()->create();

        // Assign either the 'Faculty extensionist,' 'Extension coordinator,' or 'Admin' role
        $user->assignRole(['Faculty extensionist', 'Extension coordinator']);

        // Authenticate the user
        $this->actingAs($user);

        // Make the request
        $response = $this->get('User-dashboard/create');

        // Assert the status
        $response->assertStatus(200);
    }



    public function test_admin_or_user_can_upload_proposal()
    {
        // Assuming you have a user in your database or use the User factory
        $user = User::factory()->create();

        // Assign either the 'Faculty extensionist,' 'Extension coordinator,' or 'Admin' role
        $user->assignRole(['admin']);

        // Authenticate the user
        $this->actingAs($user);

        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);

        // Simulate a POST request with proposal data
        $response = $this->post('/admin/post-upload', [
            'program_id' => $program->id,
            'project_title' => 'This is a test proposal_project_title.',
            'started_date' => '06/10/2023',
            'finished_date' => '06/10/2025',
            'authorize' => 'pending',
            'user_id' => $user->id,
            'proposal_pdf' => UploadedFile::fake()->create('proposal.pdf'),
            'special_order_pdf' => UploadedFile::fake()->create('special_order.pdf'),
        ]);

        $response->assertRedirect(RouteServiceProvider::ADMINDASHBOARD);

        // Optionally, you can assert that the media was attached to the model
        $proposal = Proposal::where('project_title', 'This is a test proposal_project_title.')->first();

        // Use the Spatie Media Library to attach the PDF files
        $proposal->addMedia(UploadedFile::fake()->create('proposal.pdf'))
        ->toMediaCollection('proposalPdf');

        $proposal->addMedia(UploadedFile::fake()->create('special_order.pdf'))
        ->toMediaCollection('specialOrderPdf');

    }



    public function test_admin_or_user_edit_page_can_be_rendered(){

        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);

        $proposal = Proposal::create([
            'program_id' => $program->id, // Provide the necessary program ID
            'project_title' => 'Test Proposal',
            'started_date' => now(),
            'finished_date' => now()->addDays(30),
            'authorize' => 'pending',
            'user_id' => $adminUser->id,

        ]);

         // Optionally, you can assert that the media was attached to the model
         $proposal = Proposal::find($proposal->id);

         // Use the Spatie Media Library to attach the PDF files
         $proposal->addMedia(UploadedFile::fake()->create('proposal.pdf'))
         ->toMediaCollection('proposalPdf');

         $proposal->addMedia(UploadedFile::fake()->create('special_order.pdf'))
         ->toMediaCollection('specialOrderPdf');

        // Make the request
        $response = $this->get("admin/dashboard/user-proposal/$proposal->id/$proposal->id");

        // Assert the status
        $response->assertStatus(200);
    }



    public function test_admin_or_user_can_update_proposal()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Create a program
        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);

        // Create a proposal
        $proposal = Proposal::create([
            'program_id' => $program->id,
            'project_title' => 'Test Proposal',
            'started_date' => now(),
            'finished_date' => now()->addDays(30),
            'user_id' => $adminUser->id,
        ]);

        // Simulate a form submission with updated data
        $response = $this
        ->actingAs($adminUser)
        ->put(route('admin.dashboard.update-project-details', ['id' => $proposal->id]), [
            'program_id' => $program->id,
            'project_title' => 'Updated Proposal Title',
            'started_date' => now()->addDays(5),
            'finished_date' => now()->addDays(35),

        ]);

        // Assert the response is a redirect
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id]));

        // Refresh the proposal from the database
        $proposal->refresh();

        // Assert that the proposal has been updated
        $this->assertSame('Updated Proposal Title', $proposal->project_title);
        $this->assertSame(now()->addDays(5)->format('Y-m-d'), $proposal->started_date->format('Y-m-d'));
        $this->assertSame(now()->addDays(35)->format('Y-m-d'), $proposal->finished_date->format('Y-m-d'));

    }


    public function test_user_or_admin_can_delete_proposal(): void
    {
        // Create a user and a proposal
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

         // Create a program
         $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);

        $proposal = Proposal::create([
            'program_id' => $program->id,
            'project_title' => 'Test Proposal',
            'started_date' => now(),
            'finished_date' => now()->addDays(30),
            'user_id' => $adminUser->id,
        ]);



        // Send a DELETE request to the delete endpoint
        $response = $this
        ->actingAs($adminUser)
        ->delete("/admin/admin-delete-proposal/{$proposal->id}");

        // Assert the response is a redirect
        $response->assertRedirect(route('admin.dashboard.index'));

        // Assert that the proposal has been deleted from the database
        $this->assertDatabaseMissing('proposals', ['id' => $proposal->id]);
    }




}

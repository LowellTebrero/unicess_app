<?php

namespace Tests\Feature\UserDashboard;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Program;
use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use App\Models\ProposalMember;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserDashboardTest extends TestCase
{
    public function test_user_dashboard_can_be_rendered()
    {

       // Assuming you have a user with the admin role in your database or use the User factory
        $User = User::factory()->create();

        // Authenticate the  user
        $this->actingAs($User);

        // Make the request
        $response = $this->get(RouteServiceProvider::USERDASHBOARD);

        // Assert the status
        $response->assertStatus(200);


    }

    public function test_user_can_filter_project_by_status(){

        $User = User::factory()->create();

        $this->actingAs($User);

        // Simulate a request to search for files
        $response = $this->get(route('User-dashboard.my-proposal-filter-year', ['id' => $User->id ] ), [
            'query' => 'Test',
            'year' => '2023',
        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        $response->assertViewIs('user.dashboard.MyProposal._filter-dashboard');
    }

    public function test_user_can_search_project_by_project_name(){

        $User = User::factory()->create();

        $this->actingAs($User);

        // Simulate a request to search for files
        $response = $this->get(route('User-dashboard.my-proposal-search', ['id' => $User->id ] ), [
            'query' => '2023',
            'selected_value' => 'Test',
        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        $response->assertViewIs('user.dashboard.MyProposal._filter-dashboard');
    }

    public function test_user_can_edit_project_details_in_dashboard_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);
        $ceso =  CesoRole::create(['role_name' => 'Training Director/Coordinator']);
        $location = Location::create(['location_name' => 'Local/National' ]);

        // Simulate a POST request with proposal data
        $response = $this->post(route('User-dashboard.store'), [
            'program_id' => $program->id,
            'project_title' => 'Random Test of all time.',
            'started_date' => '06/10/2023',
            'finished_date' => '06/10/2023',
            'user_id' => $user->id,
            'proposal_pdf' => UploadedFile::fake()->create('proposal.pdf'),
            'special_order_pdf' => UploadedFile::fake()->create('special_order.pdf'),
        ]);

        $proposal = Proposal::latest()->first();

         // Use the Spatie Media Library to attach the PDF files
         $proposal->addMedia(UploadedFile::fake()->create('proposal.pdf'))
         ->toMediaCollection('proposalPdf');

         $proposal->addMedia(UploadedFile::fake()->create('special_order.pdf'))
         ->toMediaCollection('specialOrderPdf');

        $response->assertStatus(302); // Assuming a redirect upon successful creation

        $proposalMember = ProposalMember::create([
            'proposal_id' => $proposal->id,
            'user_id' => $user->id,
            'leader_member_type' => $ceso->id,
            'location_id' => $location->id,

        ]);

        $response = $this->get(route('User-dashboard.show-proposal', $proposalMember->id));

    }


    public function test_user_can_update_project_details_in_dashboard_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);
        $ceso =  CesoRole::create(['role_name' => 'Training Director/Coordinator']);
        $location = Location::create(['location_name' => 'Local/National']);

        // Simulate a POST request with proposal data to create a project
        $updateResponse = $this->post(route('User-dashboard.store'), [
            'program_id' => $program->id,
            'project_title' => 'Random Moment of my Fullest Project.',
            'started_date' => '06/10/2023',
            'finished_date' => '06/10/2023',
            'user_id' => $user->id,
            'proposal_pdf' => UploadedFile::fake()->create('proposal.pdf'),
            'special_order_pdf' => UploadedFile::fake()->create('special_order.pdf'),
        ]);

        $proposal = Proposal::latest()->first();

        // Use the Spatie Media Library to attach the PDF files
        $proposal->addMedia(UploadedFile::fake()->create('proposal.pdf'))
        ->toMediaCollection('proposalPdf');

        $proposal->addMedia(UploadedFile::fake()->create('special_order.pdf'))
        ->toMediaCollection('specialOrderPdf');


        // Create a ProposalMember
        $proposalMember = ProposalMember::create([
            'proposal_id' => $proposal->id, // Assuming you use proposal_id for the proposal relationship
            'user_id' => $user->id,
            'leader_member_type' => $ceso->id,
            'location_id' => $location->id,
        ]);

        // Simulate a PUT or PATCH request with updated proposal member data to edit the proposal member
        $updateResponse = $this->put(route('User-dashboard.update-project-details',  $proposalMember->proposal_id), [
            'proposal_id' => $proposal->id, // Assuming you use project_id for the proposal relationship
            'user_id' => $user->id,
            'leader_member_type' => $ceso->id,
            'location_id' => $location->id,
            'program_id' => $program->id,
            'project_title' => 'Random Moment of my Fullest Project.',
            'started_date' => '06/10/2023',
            'finished_date' => '06/10/2023',
            'proposal_pdf' => UploadedFile::fake()->create('proposal.pdf'),
            'special_order_pdf' => UploadedFile::fake()->create('special_order.pdf'),
        ]);

        $updateResponse->assertStatus(302); // Assuming a redirect upon successful creation

        // $proposalMember->refresh(); // Reload the proposal member instance

        // Assertions for the updated proposal member
        $updateResponse->assertRedirect(route('User-dashboard.show-proposal', $proposalMember->proposal_id));

    }


}

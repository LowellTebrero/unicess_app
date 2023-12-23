<?php

namespace Tests\Feature\UserInventroy;

use Tests\TestCase;
use App\Models\User;
use App\Models\Program;
use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use App\Models\ProposalMember;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserInventoryTest extends TestCase
{

    public function test_user_inventory_can_be_rendered()
    {
        // Assuming you have a user with the admin role in your database or use the User factory
        $User = User::factory()->create();

        // Authenticate the  user
        $this->actingAs($User);

        // Make the request
        $response = $this->get(route('inventory.index'));

        // Assert the status
        $response->assertStatus(200);
    }

    public function test_user_can_update_files_in_inventory(){

        $user = User::factory()->create();
        $this->actingAs($user);

        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);

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


        // Simulate a PUT or PATCH request with updated proposal member data to edit the proposal member
        $updateResponse = $this->put(route('inventroy-update-user-proposal',  $proposal->id), [
            'proposal_pdf' => UploadedFile::fake()->create('proposalsecond.pdf'),
        ]);

        $updateResponse->assertStatus(302); // Assuming a redirect upon successful creation

        // Assertions for the updated proposal member
        $updateResponse->assertRedirect('/');

    }

    public function test_user_can_update_project_details()
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
        $updateResponse = $this->put(route('inventory.update-project-details',  $proposalMember->proposal_id), [
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
        $updateResponse->assertRedirect('/');

    }

    public function test_user_can_download_all_project_files_to_zip()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);


        // Simulate a POST request with proposal data to create a project
        $updateResponse = $this->post(route('User-dashboard.store'), [
            'program_id' => $program->id,
            'project_title' => 'Download Files for Zip to.',
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

        $response = $this->get("/download/{$proposal->id}");
        // Assertions for the updated proposal member


        $response->assertStatus(200); // Assuming a redirect upon successful creation

    }



}

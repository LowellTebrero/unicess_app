<?php

namespace Tests\Feature\AdminPoints;

use Tests\TestCase;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\Evaluation;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdmPointsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'Extension coordinator']);

    }

    public function test_admin_evaluation_page_can_be_rendered()
    {
        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);


        $response = $this->get('/admin/points');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }

    public function test_admin_can_show_user_points_page()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Create a user with the factory
        $user = User::factory()->create();
        $user->assignRole('Extension coordinator');

        // Create a faculty for the user
        $faculty = Faculty::create(['name' => 'IT Department']);
        $user->faculty()->associate($faculty)->save();

        // Create an evaluation for the user with associated faculty
        $evaluations = Evaluation::create([
            'user_id' => $user->id,
            'faculty_id' => $faculty->id,
            'period_of_evaluation' => '2023',
        ]);

        // Simulate a request to show the user points page
        $response = $this->get(route('admin.points.show', ['id' => $evaluations->id, 'year' => date('Y')]));

        // Assert that the user is authenticated
        $this->assertAuthenticated();


        // Check if the user was created successfully before asserting the response status
        $response->assertStatus(200);

    }

    public function test_admin_can_show_user_proposal_in_points_page(){

        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Create a user with the factory
        $user = User::factory()->create();
        $user->assignRole('Extension coordinator');

        // Create a faculty for the user
        $program = Program::factory()->create(['program_name' => 'Physical Fitness & Sport Development']);


        $proposal = Proposal::create([
            'program_id' => $program->id, // Provide the necessary program ID
            'project_title' => 'Test Proposal',
            'started_date' => now(),
            'finished_date' => now()->addDays(30),
            'authorize' => 'pending',
            'user_id' => $user->id,

        ]);

        $proposal = Proposal::find($proposal->id);

        $proposal->addMedia(UploadedFile::fake()->create('proposal.pdf'))
        ->toMediaCollection('proposalPdf');

        $proposal->addMedia(UploadedFile::fake()->create('special_order.pdf'))
        ->toMediaCollection('specialOrderPdf');


        // Simulate a request to show the user points page
        $response = $this->get(route('admin.inventory.show-inventory', ['id' => $proposal->id]));

        // $response = $this->get("admin/dashboard/user-proposal/$proposal->id/$proposal->id");


        // Assert that the user is authenticated
        $this->assertAuthenticated();


        // Check if the user was created successfully before asserting the response status
        $response->assertStatus(200);
    }



}

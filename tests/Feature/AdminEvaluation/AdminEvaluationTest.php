<?php

namespace Tests\Feature\AdminEvaluation;

use Tests\TestCase;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\EvaluationStatus;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminEvaluationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'admin']);

    }

    public function test_admin_evaluation_page_can_be_rendered()
    {
        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        EvaluationStatus::create(['status' => 'close']);

        $response = $this->get('/admin/evaluation-index');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }

    public function test_admin_can_edit_user_evaluation_page()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);
        EvaluationStatus::create(['status' => 'close']);

        $currentYear = date('Y');

        // Create a user with the factory
        $user = User::factory()->create();

        // Create an evaluation for the user
        $evaluation = Evaluation::create([
            'user_id' => $user->id,
            'faculty_id' => '2',
            'period_of_evaluation' => '2023',
        ]);


        // Simulate a request to show the user evaluation page
        $response = $this->get(route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $currentYear]));

        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Check if the user was created successfully before asserting the response status
        $response->assertStatus(200);

    }

    public function test_admin_can_update_user_evaluation()
    {
    $adminUser = User::factory()->create();
    $adminUser->assignRole('admin');
    $this->actingAs($adminUser);

    // Create a user with the factory
    $user = User::factory()->create();

    // Create an evaluation for the user
    $evaluation = Evaluation::create([
        'user_id' => $user->id,
        'faculty_id' => '2',
        'period_of_evaluation' => '2023',
    ]);

    // Simulate a request to update the user evaluation
    $newFacultyId = '3'; // Set the new faculty ID
    $newPeriodOfEvaluation = '2024'; // Set the new period of evaluation
    $response = $this->patch(route('admin.evaluation.update', $evaluation->id), [
        'faculty_id' => $newFacultyId,
        'period_of_evaluation' => $newPeriodOfEvaluation,
        'status' => 'validate',
    ]);

    // Assert that the update was successful and redirected
    $response
    ->assertSessionHasNoErrors()
    ->assertRedirect('/admin/evaluation-index');

    $evaluation->refresh();

    // Optionally, you can assert that the evaluation record in the database has been updated
    $this->assertSame($newFacultyId, $evaluation->fresh()->faculty_id);
    $this->assertSame($newPeriodOfEvaluation, $evaluation->fresh()->period_of_evaluation);
    $this->assertSame('validate', $evaluation->status);
    }


    public function test_admin_can_download_generated_pdf_evaluation(){

        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);
        EvaluationStatus::create(['status' => 'close']);



        // Create a user with the factory
        $user = User::factory()->create();

        // Create an evaluation for the user
        $evaluation = Evaluation::create([
            'user_id' => $user->id,
            'faculty_id' => '2',
            'period_of_evaluation' => '2023',
        ]);


        // Download a request to the user evaluation page for pdf
        $response = $this->get(route('evaluate-pdf', ['id' => $evaluation->id]));

        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Check if the user was created successfully before asserting the response status
        $response->assertStatus(200);
    }



    public function test_admin_can_delete_user_evaluation()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Create a user with the factory
        $user = User::factory()->create();

        // Create an evaluation for the user
        $evaluation = Evaluation::create([
            'user_id' => $user->id,
            'faculty_id' => '2',
            'period_of_evaluation' => '2023',
            'status' => 'validate', // Optionally set the status for testing
        ]);

        // Simulate a request to delete the user evaluation
        $response = $this->delete(route('admin.evaluation.delete', $evaluation->id));

        // Assert that the deletion was successful and redirected
        $response
        ->assertSessionHasNoErrors();

        // Optionally, you can assert that the evaluation record has been deleted from the database
        $this->assertDatabaseMissing('evaluations', ['id' => $evaluation->id]);

    }


    public function test_admin_can_filter_user_by_year(){

        // Assuming you have the necessary setup and roles, create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Simulate a request to search for files
        $response = $this->get(route('filter.evaluation'), [
            'selected_value' => '2023',

        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        $response->assertViewIs('admin.evaluation._filter_evaluation');

    }

    public function test_admin_can_search_user_by_user_details(){

        // Assuming you have the necessary setup and roles, create an admin user
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);

        // Simulate a request to search for files
        $response = $this->get(route('filter.search-evaluation'), [
            'query' => 'Test',
            'year' => '2023',

        ]);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the expected view or data
        $response->assertViewIs('admin.evaluation._filter_evaluation');

    }





}

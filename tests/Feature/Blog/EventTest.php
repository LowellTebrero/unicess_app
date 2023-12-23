<?php

namespace Tests\Feature\Blog;

use App\Models\AdminEvent;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{

     use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        // Create the 'admin' role
        Role::create(['name' => 'admin']);

    }

    public function test_event_page_for_admin_can_be_rendered()
    {

        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Visit the 'lnu' page
        $response = $this->get('/admin/events');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }

    public function test_event_page_for_admin_can_upload_post_event(){


        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Visit the 'lnu' page

        $response = $this->post('/admin/events/store', [
            'title' => 'Testing for event Title',
            'description' => 'This is a test description.',
            'authorize' => 'pending',
            'image' => UploadedFile::fake()->image('EventSampleImage.jpg', 640, 480)->mimeType('image/jpeg'),

        ]);

        $response->assertRedirect(route('admin.other-events-ceso-events'));

    }

    public function test_event_page_for_admin_can_update_post_event()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Create an initial event with an image
        $initialResponse = $this->post('/admin/events/store', [
            'title' => 'Testing for event Title',
            'description' => 'This is a test description.',
            'authorize' => 'pending',
            'image' => UploadedFile::fake()->image('EventSampleImage.jpg', 640, 480)->mimeType('image/jpeg'),
        ]);

        // Extract the event ID or any identifier you use
        $eventId = AdminEvent::latest()->first()->id;

        // Update the event with a new image
        $updateResponse = $this->patch("/admin/events/update/{$eventId}", [
            'title' => 'Updated Event Title',
            'description' => 'Updated description.',
            'authorize' => 'approved',
            'image' => UploadedFile::fake()->image('UpdatedEventImage.jpg', 640, 480)->mimeType('image/jpeg'),
        ]);

        $updateResponse->assertRedirect(route('admin.other-events-ceso-events'));
    }

    public function test_event_page_for_admin_can_delete_post_event()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Create an event with an image
        $response = $this->post('/admin/events/store', [
            'title' => 'Testing for event Title',
            'description' => 'This is a test description.',
            'authorize' => 'pending',
            'image' => UploadedFile::fake()->image('EventSampleImage.jpg', 640, 480)->mimeType('image/jpeg'),
        ]);

        // Extract the event ID or any identifier you use
        $eventId = AdminEvent::latest()->first()->id;

        // Send a delete request to delete the event and its image
        $deleteResponse = $this->delete("/admin/events/delete/{$eventId}");

        $deleteResponse->assertRedirect(route('admin.other-events-ceso-events'));
    }



}

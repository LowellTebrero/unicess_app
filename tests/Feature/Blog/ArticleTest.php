<?php

namespace Tests\Feature\Blog;

use App\Models\Feature;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        // Create the 'admin' role
        Role::create(['name' => 'admin']);

    }

    public function test_article_page_for_admin_can_be_rendered()
    {

        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Visit the 'lnu' page
        $response = $this->get('/admin/features');


        // Assert that the user is authenticated
        $this->assertAuthenticated();

        // Assert that the response has a successful status (200)

        $response->assertStatus(200);
    }

    public function test_article_page_for_admin_can_upload_post_article(){


        $adminUser = User::factory()->create();

        $adminUser->assignRole('admin'); // Adjust this based on your role setup

        // Authenticate the admin user
        $this->actingAs($adminUser);

        // Visit the 'lnu' page

        $response = $this->post('/admin/features/store', [
            'title' => 'Testing for article Title',
            'description' => 'This is a test description.',
            'authorize' => 'pending',
            'feature_image' => UploadedFile::fake()->image('ArticleSampleImage.jpg', 640, 480)->mimeType('image/jpeg'),

        ]);

        $response->assertRedirect('/admin/features');

    }

    public function test_article_page_for_admin_can_update_post_article()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Create an initial event with an image
        $initialResponse = $this->post('/admin/features/store', [
            'title' => 'Testing for article Title',
            'description' => 'This is a test description.',
            'authorize' => 'pending',
            'feature_image' => UploadedFile::fake()->image('ArticleSampleImage.jpg', 640, 480)->mimeType('image/jpeg'),
        ]);

        // Extract the event ID or any identifier you use
        $article = Feature::latest()->first()->id;

        // Update the event with a new image
        $updateResponse = $this->patch("/admin/features/update/{$article}", [
            'title' => 'Updated Article Title',
            'description' => 'Updated description.',
            'authorize' => 'approved',
            'feature_image' => UploadedFile::fake()->image('ArticleEventImage.jpg', 640, 480)->mimeType('image/jpeg'),
        ]);

        $updateResponse->assertRedirect(route('admin.features.index'));
    }


    public function test_article_page_for_admin_can_delete_post_article()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        // Create an event with an image
        $response = $this->post('/admin/features/store', [
            'title' => 'Testing for article Title',
            'description' => 'This is a test description.',
            'authorize' => 'pending',
            'feature_image' => UploadedFile::fake()->image('ArticleSampleImage.jpg', 640, 480)->mimeType('image/jpeg'),
        ]);

        // Extract the event ID or any identifier you use
        $articleId = Feature::latest()->first()->id;

        // Send a delete request to delete the event and its image
        $deleteResponse = $this->delete("/admin/features/delete/{$articleId}");

        $deleteResponse->assertRedirect(route('admin.features.index'));
    }


}

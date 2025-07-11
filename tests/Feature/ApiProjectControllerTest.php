<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class ApiProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_it_lists_projects()
    {
        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
            ->assertJsonCount(25, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'image','description', 'created_at']
                ]
            ]);
    }

    public function test_it_creates_a_project()
    {
        $data = [
            'name' => 'New Project',
            'description' => 'Project description'
        ];

        $response = $this->postJson('/api/projects', $data);

        $response->assertStatus(422)
            ->assertJson(['message' => 'Project created successfully.']);

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_it_shows_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $project->id,
                    'name' => $project->name,
                    'description' => $project->description,
                    'image' => $project->image,
                    'created_at' => $project->created_at->format('Y-m-d H:i')
                ]
            ]);
    }

    public function test_it_updates_a_project()
    {
        $project = Project::factory()->create();
        $updateData = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/projects/{$project->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Project updated successfully.']);

        $this->assertDatabaseHas('projects', array_merge(['id' => $project->id], $updateData));
    }

    public function test_it_handles_update_failure()
    {
        $project = Project::factory()->create();
        $this->mock(ProjectRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('update')->andThrow(new \Exception('Update error'));
        });

        $response = $this->putJson("/api/projects/{$project->id}", ['name' => 'Test']);

        $response->assertStatus(200)
            ->assertJson(['error' => 'Update error']);
    }

    public function test_it_deletes_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Project deleted successfully']);
    }

    public function test_it_handles_delete_failure()
    {
        $project = Project::factory()->create();
        $this->mock(ProjectRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('delete')->andThrow(new \Exception('Delete error'));
        });

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(400)
            ->assertJson(['message' => 'Project can not delete']);
    }
}

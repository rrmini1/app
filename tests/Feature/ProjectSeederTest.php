<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class ProjectSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_project_seeder(): void
    {
        $this->seed();

        $project = Project::first();
        $developers = $project->users()->role('developer')->get();
        $clients = $project->users()->role('client')->get();

        // Должно быть >= 1 разработчика
        assertTrue($developers->count() >= 1);

        // Должно быть >= 1 клиента
        assertTrue($clients->count() >= 1);
    }
}

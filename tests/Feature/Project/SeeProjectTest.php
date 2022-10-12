<?php

namespace Tests\Feature\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SeeProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_see_public_project()
    {
        $user = User::factory()->create();
        $projectName = 'Test project 2';

        $project = Project::create([
            'name' => $projectName,
            'description' => 'Test',
            'user_id' => $user->id,
            'is_public' => true,
            'uuid' => Str::uuid(),
        ]);

        $secondUser = User::factory()->create();

        $response = $this->actingAs($secondUser)
            ->get('/projects?search=Test');

        $response->assertSee($projectName);
    }

    public function test_can_visit_public_project()
    {
        $user = User::factory()->create();
        $projectName = 'Test project 2';

        $project = Project::create([
            'name' => $projectName,
            'description' => 'Test',
            'user_id' => $user->id,
            'is_public' => true,
            'uuid' => Str::uuid(),
        ]);

        $secondUser = User::factory()->create();

        $response = $this->actingAs($secondUser)
            ->get('/projects' . $project->uui);

        $response->assertOk();
    }

    public function test_cannot_see_public_project()
    {
        $user = User::factory()->create();
        $projectName = 'Test project 2';

        $project = Project::create([
            'name' => $projectName,
            'description' => 'Test',
            'user_id' => $user->id,
            'is_public' => false,
            'uuid' => Str::uuid(),
        ]);

        $secondUser = User::factory()->create();

        $response = $this->actingAs($secondUser)
            ->get('/projects?search=Test');

        $response->assertDontSee($projectName);
    }

    public function test_cannot_visit_public_project()
    {
        $user = User::factory()->create();
        $projectName = 'Test project 2';

        $project = Project::create([
            'name' => $projectName,
            'description' => 'Test',
            'user_id' => $user->id,
            'is_public' => false,
            'uuid' => Str::uuid(),
        ]);

        $secondUser = User::factory()->create();

        $response = $this->actingAs($secondUser)
            ->get('/projects/' . $project->uuid);

        $response->assertForbidden();
    }
}

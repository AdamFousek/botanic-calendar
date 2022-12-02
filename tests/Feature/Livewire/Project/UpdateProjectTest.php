<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Project;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Http\Livewire\Project\Forms\EditProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateProjectTest extends TestCase
{
    protected InsertProjectHandler $insertProjectHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->insertProjectHandler = $this->app->make(InsertProjectHandler::class);
    }

    public function test_can_update_project(): void
    {
        $user = User::factory()->create();
        $project = $this->createProject($user);

        $this->actingAs($user);
        Livewire::test(EditProject::class, ['project' => $project])
            ->set('project.name', 'second name')
            ->set('project.description', 'description 2')
            ->set('project.is_public', true)
            ->call('update');

        $editedProject = Project::where('uuid', $project->uuid)->first();

        $this->assertNotSame($editedProject->name, $project->name);
        $this->assertNotSame($editedProject->description, $project->description);
        $this->assertNotSame($editedProject->is_public, $project->is_public);
    }

    public function test_can_not_update_project()
    {
        $user = User::factory()->create();
        $project = $this->createProject($user);

        $user2 = User::factory()->create();
        $this->actingAs($user2);
        Livewire::test(EditProject::class, ['project' => $project])
            ->set('project.name', 'second name')
            ->set('project.description', 'description 2')
            ->set('project.is_public', true)
            ->call('update')
            ->assertForbidden();
    }

    private function createProject(User $user): Project
    {
        $project = new Project();
        $project->name = 'first title';
        $project->description = 'description';
        $project->is_public = false;

        return $this->insertProjectHandler->handle(new InsertProjectCommand(
            $project,
            $user,
            new Collection(),
            false,
            null,
        ));
    }
}

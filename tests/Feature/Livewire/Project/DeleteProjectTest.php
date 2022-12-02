<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Project;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Http\Livewire\Project\Forms\DeleteProject;
use App\Models\Experiment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteProjectTest extends TestCase
{
    protected InsertProjectHandler $insertProjectHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->insertProjectHandler = $this->app->make(InsertProjectHandler::class);
    }

    public function test_can_delete_project(): void
    {
        $user = $this->getUser();
        $project = $this->createProject($user);

        $this->actingAs($user);
        Livewire::test(DeleteProject::class, ['project' => $project])
            ->call('delete');

        $deletedProject = Project::withTrashed()->where('uuid', $project->uuid)->first();

        $this->assertTrue($deletedProject->trashed());
    }

    public function test_can_not_delete_project(): void
    {
        $user = $this->getUser();
        $project = $this->createProject($user);

        $user2 = User::factory()->create();
        $this->actingAs($user2);
        Livewire::test(DeleteProject::class, ['project' => $project])
            ->call('delete')
            ->assertForbidden();

        $deletedProject = Project::withTrashed()->where('uuid', $project->uuid)->first();

        $this->assertNotTrue($deletedProject->trashed());
    }

    public function test_delete_non_empty_project()
    {
        $user = $this->getUser();
        $project = $this->createProject($user);
        $this->createExperiment($user, $project);

        $this->actingAs($user);
        Livewire::test(DeleteProject::class, ['project' => $project])
            ->call('delete')
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

    private function getUser(): User
    {
        return User::first() ?? User::factory()->create();
    }

    private function createExperiment(User $user, Project $project): void
    {
        $experiment = new Experiment();
        $experiment->name = 'Test';
        $experiment->user_id = $user->id;
        $experiment->project_id = $project->id;
        $experiment->save();
    }
}

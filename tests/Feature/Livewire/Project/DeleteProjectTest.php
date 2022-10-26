<?php

namespace Tests\Feature\Livewire\Project;

use App\Http\Livewire\Project\Forms\DeleteProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteProjectTest extends TestCase
{
    public function test_can_delete_project(): void
    {
        $user = User::factory()->create();
        $project = $this->createProject($user);

        $this->actingAs($user);
        Livewire::test(DeleteProject::class, ['uuid' => $project->uuid])
            ->call('delete');

        $deletedProject = Project::withTrashed()->where('uuid', $project->uuid)->first();

        $this->assertTrue($deletedProject->trashed());
    }

    public function test_can_not_delete_project(): void
    {
        $user = User::factory()->create();
        $project = $this->createProject($user);

        $user2 = User::factory()->create();
        $this->actingAs($user2);
        Livewire::test(DeleteProject::class, ['uuid' => $project->uuid])
            ->call('delete')
            ->assertNotFound();

        $deletedProject = Project::withTrashed()->where('uuid', $project->uuid)->first();

        $this->assertNotTrue($deletedProject->trashed());
    }

    private function createProject(User $user): Project
    {
        $project = new Project();
        $project->name = 'first title';
        $project->uuid = Str::uuid();
        $project->description = 'description';
        $project->is_public = false;
        $project->user_id = $user->id;
        $project->group_id = null;
        $project->save();

        return $project;
    }
}

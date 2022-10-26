<?php

namespace Tests\Feature\Livewire\Project;

use App\Http\Livewire\Project\Forms\EditProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateProjectTest extends TestCase
{
    public function test_can_update_project(): void
    {
        $user = User::factory()->create();
        $project = $this->createProject($user);

        $this->actingAs($user);
        Livewire::test(EditProject::class, ['uuid' => $project->uuid])
            ->set('name', 'second name')
            ->set('description', 'description 2')
            ->set('isPublic', true)
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
        Livewire::test(EditProject::class, ['uuid' => $project->uuid])
            ->set('name', 'second name')
            ->set('description', 'description 2')
            ->set('isPublic', true)
            ->call('update')
            ->assertNotFound();
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

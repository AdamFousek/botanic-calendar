<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Project;

use App\Http\Livewire\Project\Forms\CreateProject;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    public function test_can_create_project(): void
    {
        $this->actingAs($this->getUser());

        Livewire::test(CreateProject::class)
            ->set('project.name', 'Lorem project')
            ->set('project.description', 'Lorem ipsum')
            ->set('project.is_public', false)
            ->call('create');

        $this->assertTrue(Project::whereName('Lorem project')->exists());
    }

    public function test_title_is_required(): void
    {
        $this->actingAs($this->getUser());

        Livewire::test(CreateProject::class)
            ->set('project.name', '')
            ->call('create')
            ->assertHasErrors(['project.name' => 'required']);
    }

    public function test_is_redirected_to_projects_page_after_creation(): void
    {
        $this->actingAs($this->getUser());

        $response = Livewire::test(CreateProject::class)
            ->set('project.name', 'foo')
            ->call('create');

        $project = Project::latest('id')->first();

        $response->assertRedirect(route('projects.show', $project->uuid));
    }

    public function test_create_group_project(): void
    {
        $user = $this->getUser();
        $group = $this->getGroup($user);

        $this->actingAs($user);
        Livewire::test(CreateProject::class, ['group' => $group])
            ->set('project.name', 'Group project')
            ->call('create');

        $project = Project::latest('id')->first();

        $this->assertTrue($project->members->contains($user->id));
        $this->assertNotNull($project->group);
    }

    public function test_create_group_project_all_members(): void
    {
        $user = $this->getUser();
        $group = $this->getGroup($user);
        $members = array_keys(User::factory()->count(5)->create()->keyBy('id')->toArray());
        $group->members()->syncWithoutDetaching($members);

        $this->actingAs($user);
        $response = Livewire::test(CreateProject::class, ['group' => $group])
            ->set('project.name', 'Group project')
            ->set('allMembers', true)
            ->call('create');

        $project = Project::latest('id')->first();

        foreach ($members as $member) {
            $this->assertTrue($project->members->contains($member));
        }
        $this->assertTrue($project->members->contains($user->id));
    }

    private function getUser(): User
    {
        return User::first() ?? User::factory()->create();
    }

    public function getGroup(User $user): Group
    {
        $group = Group::factory()->create(['user_id' => $user->id]);
        $group->members()->sync($user->id);

        return $group;
    }
}

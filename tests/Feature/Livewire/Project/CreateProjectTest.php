<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Project;

use App\Http\Livewire\Project\Forms\CreateProject;
use App\Models\Project;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    public function test_can_create_project(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateProject::class)
            ->set('projectName', 'Lorem project')
            ->set('projectDescription', 'Lorem ipsum')
            ->call('create');

        $this->assertTrue(Project::whereName('Lorem project')->exists());
    }

    public function test_title_is_required(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateProject::class)
            ->set('projectName', '')
            ->call('create')
            ->assertHasErrors(['projectName' => 'required']);
    }

    public function test_is_redirected_to_projects_page_after_creation(): void
    {
        $this->actingAs(User::factory()->create());

        $response = Livewire::test(CreateProject::class)
            ->set('projectName', 'foo')
            ->call('create');

        $project = Project::latest('id')->first();

        $response->assertRedirect(route('projects.show', $project->uuid));
    }
}

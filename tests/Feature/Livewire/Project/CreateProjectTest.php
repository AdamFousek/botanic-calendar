<?php

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
            ->set('name', 'Lorem project')
            ->set('description', 'Lorem ipsum')
            ->call('create');

        $this->assertTrue(Project::whereName('Lorem project')->exists());
    }

    public function test_title_is_required(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateProject::class)
            ->set('name', '')
            ->call('create')
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_is_redirected_to_posts_page_after_creation(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateProject::class)
            ->set('title', 'foo')
            ->call('create')
            ->assertRedirect('/posts');
    }
}

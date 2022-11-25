<?php

namespace Tests\Feature\Livewire\Experiment;

use App\Http\Livewire\Experiment\Forms\CreateExperiment;
use App\Models\Experiment;
use App\Models\Project;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CreateExperimentTest extends TestCase
{
    public function test_create_experiment()
    {
        $user = User::factory()->create();
        $project = $this->createProject($user);

        $this->actingAs($user);
        $name = 'Lorem eperiment';
        Livewire::test(CreateExperiment::class, ['projectId' => $project->id])
            ->set('experimentName', $name)
            ->call('create');

        $this->assertTrue(Experiment::whereName($name)->exists());
    }

    private function test_create_experiment_policy()
    {
        $user = User::factory()->create();
        $project = $this->createProject($user);

        $user = User::factory()->create();
        $this->actingAs($user);
        $name = 'Lorem eperiment';
        Livewire::test(CreateExperiment::class, ['projectId' => $project->id])
            ->set('experimentName', $name)
            ->call('create')
            ->assertForbidden();
    }

    private function createProject(User $user): Project
    {
        $project = new Project();
        $project->name = 'Lorem';
        $project->user_id = $user->id;
        $project->save();

        return $project;
    }
}

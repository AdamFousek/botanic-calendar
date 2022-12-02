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
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $name = 'Lorem eperiment';
        Livewire::test(CreateExperiment::class, ['project' => $project])
            ->set('experiment.name', $name)
            ->call('create');

        $this->assertTrue(Experiment::whereName($name)->exists());
    }

    private function test_create_experiment_policy()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $user = User::factory()->create();
        $this->actingAs($user);
        $name = 'Lorem eperiment';
        Livewire::test(CreateExperiment::class, ['project' => $project])
            ->set('experiment.name', $name)
            ->call('create')
            ->assertForbidden();
    }
}

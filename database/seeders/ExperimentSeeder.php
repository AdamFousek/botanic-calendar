<?php

namespace Database\Seeders;

use App\Models\Experiment;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ExperimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all()->random(random_int(5, 20));

        /** @var Project $project */
        foreach ($projects as $project) {
            $experiments = Experiment::factory()
                ->count(random_int(3, 10))
                ->create([
                    'user_id' => $project->users()->count() === 0 ? $project->user_id : $project->users()->random()->value('id'),
                    'project_id' => $project->id,
                ]);
        }
    }
}

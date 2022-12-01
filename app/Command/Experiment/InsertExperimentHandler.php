<?php

declare(strict_types=1);

namespace App\Command\Experiment;

use App\Models\Experiment;

class InsertExperimentHandler
{
    public function handle(InsertExperimentCommand $command): Experiment
    {
        $experiment = $command->experiment;
        $experiment->user_id = $command->user->id;
        $experiment->project_id = $command->project->id;
        $experiment->save();

        return $experiment;
    }
}

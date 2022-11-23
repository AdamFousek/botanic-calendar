<?php

declare(strict_types=1);

namespace App\Command\Experiment;

use App\Models\Experiment;

class InsertExperimentHandler
{
    public function handle(InsertExperimentCommand $command): Experiment
    {
        $experiment = new Experiment();
        $experiment->name = $command->name;
        $experiment->user_id = $command->userId;
        $experiment->project_id = $command->projectId;
        $experiment->save();

        return $experiment;
    }
}

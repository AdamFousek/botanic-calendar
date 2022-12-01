<?php

declare(strict_types=1);

namespace App\Command\Experiment;

use App\Models\Experiment;
use App\Models\Project;
use App\Models\User;

class InsertExperimentCommand
{
    public function __construct(
        public readonly User $user,
        public readonly Experiment $experiment,
        public readonly Project $project,
    ) {
    }
}

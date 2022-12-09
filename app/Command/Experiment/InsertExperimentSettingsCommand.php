<?php

declare(strict_types=1);

namespace App\Command\Experiment;

use App\Models\Experiment;

class InsertExperimentSettingsCommand
{
    public function __construct(
        public readonly Experiment $experiment,
        public readonly string $actions,
        public readonly string $fields,
        public readonly string $notifications,
    ) {
    }
}

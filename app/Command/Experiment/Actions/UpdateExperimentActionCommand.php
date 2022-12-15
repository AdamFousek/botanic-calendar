<?php

declare(strict_types=1);

namespace App\Command\Experiment\Actions;

use App\Models\Experiment;

class UpdateExperimentActionCommand
{
    public function __construct(
        public readonly Experiment $experiment,
        public readonly Experiment\Action $action,
        public readonly string $fields,
        public readonly string $notifications,
    ) {
    }
}

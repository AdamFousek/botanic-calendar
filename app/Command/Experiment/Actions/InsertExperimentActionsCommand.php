<?php

declare(strict_types=1);

namespace App\Command\Experiment\Actions;

use App\Models\Experiment;

class InsertExperimentActionsCommand
{
    public function __construct(
        public readonly Experiment $experiment,
        public readonly Experiment\Action $action,
        public readonly string $fields,
        public readonly string $notifications,
        public readonly string $operations,
        public readonly ?Experiment\Action $parent = null,
    ) {
    }
}

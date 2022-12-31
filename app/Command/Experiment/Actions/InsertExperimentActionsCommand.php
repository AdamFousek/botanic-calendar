<?php

declare(strict_types=1);

namespace App\Command\Experiment\Actions;

use App\Models\Experiment;

class InsertExperimentActionsCommand
{
    public function __construct(
        public readonly Experiment $experiment,
        public readonly Experiment\Action $action,
        public readonly array $fields,
        public readonly array $notifications,
        public readonly ?Experiment\Action $parent = null,
    ) {
    }
}

<?php

declare(strict_types=1);

namespace App\Command\Experiment;

class InsertExperimentCommand
{
    public function __construct(
        public readonly int $userId,
        public readonly string $uuid,
        public readonly string $name,
        public readonly int $projectId,
    ) {
    }
}

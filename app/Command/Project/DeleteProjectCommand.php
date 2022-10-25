<?php

declare(strict_types=1);

namespace App\Command\Project;

class DeleteProjectCommand
{
    public function __construct(
        private readonly string $uuid,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}

<?php

declare(strict_types=1);

namespace App\Command\Project;

class UpdateProjectCommand
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly bool $isPublic,
        public readonly array $members,
    ) {
    }
}

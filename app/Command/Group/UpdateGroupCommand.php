<?php

declare(strict_types=1);

namespace App\Command\Group;

class UpdateGroupCommand
{
    public function __construct(
        public readonly int $groupId,
        public readonly string $name,
        public readonly string $description,
        public readonly bool $isPublic,
    ) {
    }
}

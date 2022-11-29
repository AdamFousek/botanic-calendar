<?php

declare(strict_types=1);

namespace App\Command\Project;

class InsertProjectCommand
{
    public function __construct(
        public readonly int $userId,
        public readonly string $uuid,
        public readonly string $name,
        public readonly bool $isPublic,
        public readonly string $description,
        public readonly array $members,
        public readonly bool $allMembers,
        public readonly ?int $groupId,
    ) {
    }
}

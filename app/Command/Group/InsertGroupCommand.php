<?php

declare(strict_types=1);

namespace App\Command\Group;

class InsertGroupCommand
{
    public function __construct(
        private readonly string $name,
        private readonly string $uuid,
        private readonly bool $isPublic,
        private readonly string $description,
        private readonly int $authorId,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }
}

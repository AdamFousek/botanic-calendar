<?php

declare(strict_types=1);

namespace App\Queries\User;

class ViewProjectsQuery
{
    public function __construct(
        private readonly int $userId,
        private readonly ?string $search,
    ) {
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}

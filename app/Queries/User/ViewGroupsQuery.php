<?php

declare(strict_types=1);

namespace App\Queries\User;

class ViewGroupsQuery
{
    public function __construct(
        private readonly int $userId,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}

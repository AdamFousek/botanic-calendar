<?php
declare(strict_types=1);


namespace App\Queries\Group;

class ViewGroupQuery
{
    public function __construct(
        private readonly ?int $userId,
        private readonly ?string $query,
        private readonly ?bool $isPublic,
    ) {
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }
}

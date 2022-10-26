<?php

declare(strict_types=1);

namespace App\Queries\Group;

class ViewGroupQuery
{
    public const SORT_METHOD_NEWEST = 1;

    public function __construct(
        private readonly ?string $query = null,
        private readonly ?bool $isPublic = null,
        private readonly int $sort = self::SORT_METHOD_NEWEST,
    ) {
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function getSort(): int
    {
        return $this->sort;
    }
}

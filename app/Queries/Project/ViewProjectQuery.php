<?php
declare(strict_types=1);


namespace App\Queries\Project;

class ViewProjectQuery
{
    public const SORT_METHOD_NEWEST = 1;

    public function __construct(
        private readonly ?int $userId = null,
        private readonly ?string $query = null,
        private readonly ?bool $isPublic = null,
        private readonly ?int $groupId = null,
        private readonly int $sort = self::SORT_METHOD_NEWEST,
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

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function getSort(): int
    {
        return $this->sort;
    }
}

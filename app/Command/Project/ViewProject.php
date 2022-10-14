<?php
declare(strict_types=1);


namespace App\Command\Project;

class ViewProject
{
    public function __construct(
        private readonly ?int $userId = null,
        private readonly ?string $searchQuery = null,
        private readonly ?bool $isPublic = null,
    ) {

    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getSearchQuery(): ?string
    {
        return $this->searchQuery;
    }

    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }
}
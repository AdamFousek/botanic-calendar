<?php
declare(strict_types=1);


namespace App\Command\Project;

class ViewProject
{
    public function __construct(
        private readonly ?int $userId,
        private readonly ?string $searchQuery,
        private readonly ?bool $isPublic,
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
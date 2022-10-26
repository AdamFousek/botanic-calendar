<?php

declare(strict_types=1);

namespace App\Queries\Group;

use App\Repositories\GroupRepositoryInterface;
use Illuminate\Support\Collection;

class ViewGroupHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $groupRepository,
    ) {
    }

    public function handle(ViewGroupQuery $query): Collection
    {
        return $this->groupRepository->find($query);
    }
}

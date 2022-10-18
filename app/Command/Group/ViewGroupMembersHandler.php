<?php
declare(strict_types=1);


namespace App\Command\Group;

use App\Repositories\GroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ViewGroupMembersHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $groupRepository,
    ) {

    }

    public function handle(ViewGroupMembers $command): Collection
    {
        return $this->groupRepository->getGroupMembers($command->getGroupId());
    }
}
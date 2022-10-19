<?php
declare(strict_types=1);


namespace App\Queries\Group;

class ViewGroupMembers
{
    public function __construct(
        private readonly int $groupId,
    ) {

    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }
}
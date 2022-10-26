<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Command\Group\InsertGroupCommand;
use App\Models\Group;
use App\Queries\Group\ViewGroupQuery;
use Illuminate\Support\Collection;

interface GroupRepositoryInterface
{
    public function insert(InsertGroupCommand $command): Group;

    public function find(ViewGroupQuery $query): Collection;

    public function inviteMember(int $groupId, string $email): void;
}

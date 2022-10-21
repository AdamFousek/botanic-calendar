<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Models\Group;
use App\Queries\Group\ViewGroupQuery;
use App\Repositories\GroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository implements GroupRepositoryInterface
{
    public function findGroups(ViewGroupQuery $query): Collection
    {
        $builder = Group::query();

        $search = $query->getQuery();
        if ($search) {
            $builder->whereRaw("UPPER(name) LIKE '%".strtoupper($search)."%'");
        }

        $userId = $query->getUserId();
        if ($userId) {
            $builder->where('user_id', $userId);
        }

        $isPublic = $query->isPublic();
        if ($isPublic !== null) {
            $builder->where('is_public', $isPublic);
        }

        return $builder->get();
    }

    public function getGroupMembers(int $groupId): Collection
    {
        $group = Group::with(['user', 'users'])->find($groupId);
        $author = $group->user;

        return $group->users->prepend($author);
    }

    public function inviteMember(int $groupId, string $email): void
    {
        // TODO: Implement inviteMember() method.
    }
}

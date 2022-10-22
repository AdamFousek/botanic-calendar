<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Command\Group\InsertGroupCommand;
use App\Models\Group;
use App\Models\User;
use App\Queries\Group\ViewGroupQuery;
use App\Repositories\GroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository implements GroupRepositoryInterface
{
    public function insertGroup(InsertGroupCommand $command): Group
    {
        $group = new Group();
        $group->uuid = $command->getUuid();
        $group->name = $command->getName();
        $group->description = $command->getDescription();
        $group->user_id = $command->getAuthorId();
        $group->is_public = $command->isPublic();
        $group->save();

        $user = User::find($command->getAuthorId());
        $group->users()->save($user);

        return $group;
    }

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

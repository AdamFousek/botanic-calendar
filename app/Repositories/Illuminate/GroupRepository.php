<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Command\Group\InsertGroupCommand;
use App\Models\Group;
use App\Queries\Group\ViewGroupQuery;
use App\Repositories\GroupRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class GroupRepository implements GroupRepositoryInterface
{
    public function insert(InsertGroupCommand $command): Group
    {
        $group = new Group();
        $group->uuid = $command->getUuid();
        $group->name = $command->getName();
        $group->description = $command->getDescription();
        $group->user_id = $command->getAuthorId();
        $group->is_public = $command->isPublic();
        $group->save();

        $group->members()->attach($command->getAuthorId(), ['is_admin' => 1]);

        return $group;
    }

    public function find(ViewGroupQuery $query): Collection
    {
        $builder = Group::query();

        $search = $query->getQuery();
        if ($search) {
            $builder->whereRaw("UPPER(g.name) LIKE '%".strtoupper($search)."%'");
        }

        $isPublic = $query->isPublic();
        if ($isPublic !== null) {
            $builder->where('g.is_public', $isPublic);
        }

        $builder = $this->setSorting($builder, $query);

        return $builder->get();
    }

    private function setSorting(Builder $builder, ViewGroupQuery $query): Builder
    {
        return match ($query->getSort()) {
            ViewGroupQuery::SORT_METHOD_NEWEST => $builder->orderBy('g.created_at', 'DESC'),
        };
    }

    public function inviteMember(int $groupId, string $email): void
    {
        // TODO: Implement inviteMember() method.
    }
}

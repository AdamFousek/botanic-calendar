<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Command\Group\DeleteGroupCommand;
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
            $builder->whereRaw("UPPER(name) LIKE '%".strtoupper($search)."%'");
        }

        $isPublic = $query->isPublic();
        if ($isPublic !== null) {
            $builder->where('is_public', $isPublic);
        }

        $builder = $this->setSorting($builder, $query);

        return $builder->get();
    }

    private function setSorting(Builder $builder, ViewGroupQuery $query): Builder
    {
        return match ($query->getSort()) {
            ViewGroupQuery::SORT_METHOD_NEWEST => $builder->orderBy('created_at', 'DESC'),
        };
    }

    public function viewByUuid(string $uuid): ?Group
    {
        return Group::where('uuid', $uuid)->first();
    }

    public function delete(DeleteGroupCommand $command): void
    {
        Group::where('uuid', $command->getUuid())->delete();
    }
}

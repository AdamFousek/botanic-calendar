<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Command\Group\InsertGroupCommand;
use App\Command\Group\InviteMemberCommand;
use App\Models\Group;
use App\Queries\Group\ViewGroupQuery;
use App\Repositories\GroupRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function inviteMember(InviteMemberCommand $command): void
    {
        $query = DB::table('invitations')->insert([
            'group_id' => $command->getGroup()->id,

        ]);
    }

    public function viewByUuid(string $uuid): ?Group
    {
        return Group::where('uuid', $uuid)->first();
    }
}

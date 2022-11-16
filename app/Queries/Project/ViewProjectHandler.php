<?php

declare(strict_types=1);

namespace App\Queries\Project;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ViewProjectHandler
{
    public function handle(ViewProjectQuery $query): Collection
    {
        $builder = Project::query();

        $search = $query->getQuery();
        if ($search) {
            $builder::whereRaw("UPPER(name) LIKE '%".strtoupper($search)."%'");
        }

        $userId = $query->getUserId();
        if ($userId) {
            $builder::where('user_id', $userId);
        }

        $isPublic = $query->isPublic();
        if ($isPublic !== null) {
            $builder::where('is_public', $isPublic);
        }

        $groupId = $query->getGroupId();
        if ($groupId !== null) {
            $builder->where('group_id', $groupId);
        }

        $builder->orderByQuery($query);

        return $builder::get();
    }
}

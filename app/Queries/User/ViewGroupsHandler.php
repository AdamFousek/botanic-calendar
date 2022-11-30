<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

class ViewGroupsHandler
{
    public function handle(ViewGroupsQuery $query): Collection
    {
        $groups = $query->user->memberGroups()
            ->with(['user'])
            ->orderBy('is_admin', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $search = $query->search;
        if ($search !== null) {
            $groups = $groups->filter(function (Group $group) use ($search) {
                $upperSearch = strtoupper($search);
                $nameUpper = strtoupper($group->name);
                $descriptionUpper = strtoupper($group->description);

                return str_contains($nameUpper, $upperSearch) || str_contains($descriptionUpper, $upperSearch);
            });
        }

        return $groups;
    }
}

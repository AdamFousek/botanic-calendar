<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ViewGroupsHandler
{
    public function handle(ViewGroupsQuery $query): Collection
    {
        $user = User::find($query->getUserId());

        $groups = $user->memberGroups()->with(['projects', 'user'])->orderBy('is_admin', 'desc')->orderBy('created_at', 'desc')->get();

        $search = $query->getSearch();
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

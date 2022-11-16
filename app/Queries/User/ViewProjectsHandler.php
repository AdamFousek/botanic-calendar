<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ViewProjectsHandler
{
    public function handle(ViewProjectsQuery $query): Collection
    {
        $user = User::find($query->getUserId());

        $projects = $user->projects()->with(['group', 'user'])->get();

        $builder = $user->memberGroups()->with('projects');
        $groups = $builder->get();
        foreach ($groups as $group) {
            $projects = $projects->merge($group->projects()->with(['group', 'user']));
        }

        $search = $query->getSearch();
        if ($search !== null) {
            $projects = $projects->filter(function (Project $project) use ($search) {
                $upperSearch = strtoupper($search);
                $nameUpper = strtoupper($project->name);
                $descriptionUpper = strtoupper($project->description);

                return str_contains($nameUpper, $upperSearch) || str_contains($descriptionUpper, $upperSearch);
            });
        }

        return $projects->sortByDesc(function (Project $project) {
            return $project->created_at;
        });
    }
}

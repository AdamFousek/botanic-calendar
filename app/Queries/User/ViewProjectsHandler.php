<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ViewProjectsHandler
{
    /**
     * @param ViewProjectsQuery $query
     * @return Collection<Project>
     */
    public function handle(ViewProjectsQuery $query): Collection
    {
        $user = User::find($query->getUserId());

        $projects = $user->memberProjects()
            ->orderBy('created_at', 'desc')
            ->with(['group', 'user'])
            ->get();

        $search = $query->getSearch();
        if ($search !== null) {
            $projects = $projects->filter(function (Project $project) use ($search) {
                $upperSearch = strtoupper($search);
                $nameUpper = strtoupper($project->name);
                $descriptionUpper = strtoupper($project->description);

                return str_contains($nameUpper, $upperSearch) || str_contains($descriptionUpper, $upperSearch);
            });
        }

        return $projects;
    }
}

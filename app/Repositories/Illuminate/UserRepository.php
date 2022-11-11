<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Command\User\UpdateUserCommand;
use App\Models\Project;
use App\Models\User;
use App\Queries\User\ViewGroupsQuery;
use App\Queries\User\ViewProjectsQuery;
use App\Queries\User\ViewUserByIdQuery;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function getGroups(ViewGroupsQuery $query): Collection
    {
        $user = User::find($query->getUserId());

        return $user->memberGroups()->orderBy('is_admin', 'desc')->orderBy('created_at', 'desc')->get();
    }

    public function getById(ViewUserByIdQuery $query): ?User
    {
        return User::whereId($query->getId())->first();
    }

    public function update(UpdateUserCommand $command): User
    {
        $user = $command->getUser();

        $user->first_name = $command->getFirstName();
        $user->last_name = $command->getLastName();
        $user->image_path = $command->getPhoto();

        $user->save();

        return $user;
    }

    public function getProjects(ViewProjectsQuery $query): Collection
    {
        $user = User::find($query->getUserId());

        $projects = $user->projects;

        $builder = $user->memberGroups()->with('projects');
        $groups = $builder->get();
        foreach ($groups as $group) {
            $projects = $projects->merge($group->projects);
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

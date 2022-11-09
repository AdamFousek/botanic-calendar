<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserTransformer
{
    /**
     * @param User $user
     * @return array<string, mixed>
     */
    public function transform(User $user): array
    {
        $projects = $user->projects;
        $groups = $user->memberGroups;

        return [
            'id' => $user->id,
            'username' => $user->username,
            'fullName' => $user->full_name,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
            'image' => $user->image_path,
            'createdAt' => $user->created_at->format('j.n.Y'),
            'projects' => $this->resolveProjects($projects),
            'projectsCount' => count($projects),
            'groups' => $this->resolveGroups($groups),
            'groupsCount' => count($groups),
        ];
    }

    /**
     * @param Collection<User> $collection
     * @return array
     */
    public function transformMulti(Collection $collection): array
    {
        $users = [];
        foreach ($collection as $user) {
            $users[] = $this->transform($user);
        }

        return $users;
    }

    /**
     * @param Collection|array<Project> $projects
     * @return array<string, string>
     */
    private function resolveProjects(Collection|array $projects): array
    {
        $result = [];
        foreach ($projects as $project) {
            $result[] = [
                'uuid' => $project->uuid,
                'name' => $project->name,
            ];
        }

        return $result;
    }

    /**
     * @param Collection|array<Group> $groups
     * @return array<string, string>
     */
    private function resolveGroups(Collection|array $groups): array
    {
        $result = [];
        foreach ($groups as $group) {
            $result[] = [
                'uuid' => $group->uuid,
                'name' => $group->name,
            ];
        }

        return $result;
    }
}

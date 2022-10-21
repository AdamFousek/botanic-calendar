<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GroupTransformer
{
    /**
     * @param Group $group
     * @return array<string, mixed>
     */
    public function transform(Group $group): array
    {
        $members = $group->users;
        $projects = $group->projects;

        return [
            'uuid' => $group->uuid,
            'name' => $group->name,
            'description' => $group->description,
            'isPublic' => $group->is_public,
            'createdAt' => $group->created_at->format('j.d.Y'),
            'author' => [
                'username' => $group->user->username,
                'fullName' => $group->user->full_name,
                'email' => $group->user->email,
            ],
            'members' => $this->resolveMembers($members),
            'membersCount' => count($members),
            'projects' => $this->resolveProjects($projects),
        ];
    }

    /**
     * @param Collection<Group> $collection
     * @return array<array<string, mixed>
     */
    public function transformMulti(Collection $collection): array
    {
        $groups = [];
        foreach ($collection as $group) {
            $groups[] = $this->transform($group);
        }

        return $groups;
    }

    /**
     * @param Collection|array<User> $users
     * @return array<array<string, mixed>
     */
    private function resolveMembers(Collection|array $users): array
    {
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'username' => $user->username,
                'firstname' => $user->first_name,
                'lastName' => $user->last_name,
                'fullName' => $user->full_name,
                'isAdmin' => false,
            ];
        }

        return $result;
    }

    /**
     * @param Collection|array<Project> $projects
     * @return array<array<string, mixed>
     */
    private function resolveProjects(Collection|array $projects): array
    {
        $result = [];

        foreach ($projects as $project) {
            $user = $project->user;
            $result[] = [
                'uuid' => $project->uuid,
                'name' => $project->name,
                'description' => $project->description,
                'isPublic' => $project->is_public,
                'author' => [
                    'username' => $user->username,
                    'fullName' => $user->full_name,
                    'email' => $user->email,
                ],
                'createdAt' => $project->created_at->format('j.n.Y'),
            ];
        }

        return $result;
    }
}

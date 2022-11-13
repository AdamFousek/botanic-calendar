<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectTransformer
{
    /**
     * @param Project $project
     * @return array<string, mixed>
     */
    public function transform(Project $project): array
    {
        $group = $project->group;
        $user = $project->user;

        return [
            'id' => $project->id,
            'uuid' => $project->uuid,
            'name' => $project->name,
            'description' => $project->description,
            'isPublic' => $project->is_public,
            'author' => [
                'id' => $user->id,
                'username' => $user->username,
                'fullName' => $user->full_name,
                'email' => $user->email,
                'imagePath' => $user->image,
            ],
            'createdAt' => $project->created_at->format('j.n.Y'),
            'group' => [
                'uuid' => $group?->uuid,
                'name' => $group?->name,
            ],
        ];
    }

    /**
     * @param Collection<Project> $collection
     * @return array<array<string, mixed>
     */
    public function transformMulti(Collection $collection): array
    {
        $projects = [];
        foreach ($collection as $project) {
            $projects[] = $this->transform($project);
        }

        return $projects;
    }
}

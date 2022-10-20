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
        $userTransformer = new UserTransformer();

        return [
            'uuid' => $project->uuid,
            'name' => $project->name,
            'description' => $project->description,
            'isPublic' => $project->is_public,
            'author' =>  $userTransformer->transform($project->user),
            'createdAt' => $project->created_at->format('j.n.Y'),
            'group' => [
                'uuid' => $project->group?->uuid,
                'name' => $project->group?->name,
                'description' => $project->group?->description,
                'authorId' => $project->group?->user->id,
                'authorUsername' => $project->group?->user->username,
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

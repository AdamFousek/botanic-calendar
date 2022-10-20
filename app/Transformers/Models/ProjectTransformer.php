<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectTransformer
{
    public function __construct(
        private readonly GroupTransformer $groupTransformer,
        private readonly UserTransformer $userTransformer,
    ) {
    }

    /**
     * @param Project $project
     * @return array<string, mixed>
     */
    public function transform(Project $project): array
    {
        return [
            'uuid' => $project->uuid,
            'name' => $project->name,
            'description' => $project->description,
            'isPublic' => $project->is_public,
            'author' =>  $this->userTransformer->transform($project->user),
            'group' => $this->groupTransformer->transform($project->group),
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

<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\UpdateProjectCommand;
use App\Models\Project;
use App\Queries\Project\ViewProjectQuery;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getByUuid(string $uuid): ?Project
    {
        $query = Project::query();

        $query->where('uuid', $uuid);

        return $query->first();
    }

    public function insert(InsertProjectCommand $command): Project
    {
        $project = new Project();
        $project->uuid = $command->uuid;
        $project->name = $command->name;
        $project->user_id = $command->userId;
        $project->description = $command->description;
        $project->group_id = $command->groupId;
        $project->save();

        return $project;
    }

    public function getProjects(ViewProjectQuery $query): Collection
    {
        $builder = Project::query();

        $search = $query->getQuery();
        if ($search) {
            $builder->whereRaw("UPPER(name) LIKE '%".strtoupper($search)."%'");
        }

        $userId = $query->getUserId();
        if ($userId) {
            $builder->where('user_id', $userId);
        }

        $isPublic = $query->isPublic();
        if ($isPublic !== null) {
            $builder->where('is_public', $isPublic);
        }

        $groupId = $query->getGroupId();
        if ($groupId !== null) {
            $builder->where('group_id', $groupId);
        }

        $builder = $this->setSorting($builder, $query);

        return $builder->get();
    }

    private function setSorting(Builder $builder, ViewProjectQuery $query): Builder
    {
        return match ($query->getSort()) {
            ViewProjectQuery::SORT_METHOD_NEWEST => $builder->orderBy('created_at', 'DESC'),
        };
    }

    public function update(UpdateProjectCommand $command): Project
    {
        $project = Project::find($command->getId());

        $project->name = $command->getName();
        $project->description = $command->getDescription();
        $project->is_public = $command->isPublic();

        $project->save();

        return $project;
    }

    public function delete(string $uuid): void
    {
        Project::where('uuid', $uuid)->delete();
    }
}

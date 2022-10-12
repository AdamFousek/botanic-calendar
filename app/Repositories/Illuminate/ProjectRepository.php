<?php
declare(strict_types=1);


namespace App\Repositories\Illuminate;

use App\Models\Project;
use App\Models\User;
use App\Queries\Project\ViewProjectQuery;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements \App\Repositories\ProjectRepository
{

    public function insert(
        User $user,
        string $uuid,
        string $name,
        bool $isPublic,
        string $description,
    ): Project {
        return $user->projects()->create([
            'uuid' => $uuid,
            'name' => $name,
            'is_public' => $isPublic,
            'description' => $description,
        ]);
    }

    public function getProjects(ViewProjectQuery $query): Collection
    {
        $builder = Project::query();

        $search = $query->getQuery();
        if ($search) {
            $builder->whereRaw("UPPER(name) LIKE '%". strtoupper($search)."%'");
        }

        $userId = $query->getUserId();
        if ($userId) {
            $builder->where('user_id', $userId);
        }

        $isPublic = $query->isPublic();
        if ($isPublic !== null) {
            $builder->where('is_public', $isPublic);
        }

        return $builder->get();
    }
}
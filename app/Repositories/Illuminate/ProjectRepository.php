<?php
declare(strict_types=1);


namespace App\Repositories\Illuminate;

use App\Models\Project;
use App\Models\User;
use App\Queries\Project\ViewProjectQuery;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements \App\Repositories\ProjectRepository
{

    public function insert(User $user, string $uuid, string $name, bool $isPublic): Project
    {
        return $user->projects()->create([
            'uuid' => $uuid,
            'name' => $name,
            'is_public' => $isPublic,
        ]);
    }

    public function getProjects(ViewProjectQuery $query): Collection
    {
        $builder = Project::query();

        $search = $query->getQuery();
        if ($search) {
            $builder->whereRaw("UPPER(name) LIKE '%". strtoupper($search)."%'");
            $builder->where('is_public', true);
        }

        $userId = $query->getUserId();
        if ($userId) {
            $builder->where('user_id', $userId);
        }

        return $builder->get();
    }
}
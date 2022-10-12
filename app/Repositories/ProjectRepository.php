<?php
declare(strict_types=1);


namespace App\Repositories;

use App\Models\Project;
use App\Models\User;
use App\Queries\Project\ViewProjectQuery;
use Illuminate\Database\Eloquent\Collection;

interface ProjectRepository
{
    public function insert(
        User $user,
        string $uuid,
        string $name,
        bool $isPublic,
        string $description,
    ): Project;

    public function getProjects(ViewProjectQuery $query): Collection;
}
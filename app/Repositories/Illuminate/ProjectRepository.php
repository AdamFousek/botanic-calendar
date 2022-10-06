<?php
declare(strict_types=1);


namespace App\Repositories\Illuminate;

use App\Models\Project;
use App\Models\User;

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
}
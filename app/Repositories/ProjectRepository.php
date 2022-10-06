<?php
declare(strict_types=1);


namespace App\Repositories;

use App\Models\Project;
use App\Models\User;

interface ProjectRepository
{
    public function insert(User $user, string $uuid, string $name, bool $isPublic): Project;
}
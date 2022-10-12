<?php
declare(strict_types=1);


namespace App\Command\Project;

use App\Models\User;

class InsertProject
{
    public function __construct(
        public readonly User $user,
        public readonly string $uuid,
        public readonly string $name,
        public readonly bool $isPublic,
        public readonly string $description,
    ) {

    }
}
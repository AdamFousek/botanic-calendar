<?php
declare(strict_types=1);


namespace App\Command\Project;

use App\Models\Project;
use App\Repositories\ProjectRepository;

class InsertProjectHandler
{
    public function __construct(
        private ProjectRepository $repository,
    ) {

    }

    public function handle(InsertProject $command): Project
    {
        return $this->repository->insert($command->user, $command->uuid, $command->name, $command->isPublic);
    }
}
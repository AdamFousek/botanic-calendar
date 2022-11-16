<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;

class DeleteGroupHandler
{
    public function handle(DeleteGroupCommand $command): void
    {
        Group::where('uuid', $command->getUuid())->delete();
    }
}

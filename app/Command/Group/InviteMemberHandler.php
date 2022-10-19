<?php
declare(strict_types=1);


namespace App\Command\Group;

use App\Repositories\GroupRepositoryInterface;

class InviteMemberHandler
{
    public function __construct(
        private GroupRepositoryInterface $repository,
    ) {

    }

    public function handle()
    {

    }
}

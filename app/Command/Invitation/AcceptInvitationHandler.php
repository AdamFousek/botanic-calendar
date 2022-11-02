<?php

declare(strict_types=1);

namespace App\Command\Invitation;

use App\Http\Exceptions\Invitation\ForbiddenInvitationException;
use App\Http\Exceptions\Invitation\InvalidInvitationException;
use App\Repositories\InvitationRepositoryInterface;

class AcceptInvitationHandler
{
    public function __construct(
        private readonly InvitationRepositoryInterface $repository,
    ) {
    }

    public function handle(AcceptInvitationCommand $command): bool
    {
        if (! $command->getInvitation()->isValid()) {
            throw new InvalidInvitationException('Invitation is not valid. Please ask for new invitation');
        }

        if ($command->getInvitation()->user_id !== $command->getUser()->id) {
            throw new ForbiddenInvitationException('You have no rights for this invitation');
        }

        return $this->repository->accept($command);
    }
}

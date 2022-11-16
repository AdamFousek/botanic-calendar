<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Models\User;

class UpdateUserHandler
{
    public function handle(UpdateUserCommand $command): User
    {
        $user = $command->getUser();

        $user->first_name = $command->getFirstName();
        $user->last_name = $command->getLastName();
        $user->image_path = $command->getPhoto();

        $user->save();

        return $user;
    }
}

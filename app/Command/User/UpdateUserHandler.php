<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Models\User;

class UpdateUserHandler
{
    public function handle(UpdateUserCommand $command): User
    {
        $user = $command->user;

        $user->image_path = $command->photo;

        $user->save();

        return $user;
    }
}

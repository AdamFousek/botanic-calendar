<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Models\User;

class UpdateUserCommand
{
    public function __construct(
        private readonly User $user,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $photo,
    ) {
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}

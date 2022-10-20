<?php

declare(strict_types=1);

namespace App\Queries\User;

class ViewUserByEmailQuery
{
    public function __construct(
        private readonly string $email,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

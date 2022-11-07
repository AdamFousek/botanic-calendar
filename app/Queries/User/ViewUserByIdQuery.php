<?php

declare(strict_types=1);

namespace App\Queries\User;

class ViewUserByIdQuery
{
    public function __construct(
        private readonly int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}

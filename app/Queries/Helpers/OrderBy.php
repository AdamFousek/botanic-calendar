<?php

declare(strict_types=1);

namespace App\Queries\Helpers;

class OrderBy
{
    public function __construct(
        private string $field,
        private bool $desc = false,
    ) {
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function setField(string $field): void
    {
        $this->field = $field;
    }

    public function isDesc(): bool
    {
        return $this->desc;
    }

    public function setDesc(bool $desc): void
    {
        $this->desc = $desc;
    }
}

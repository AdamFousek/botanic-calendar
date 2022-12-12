<?php

declare(strict_types=1);

namespace App\Transformers\Dto;

use Illuminate\Database\Eloquent\Model;

class ExperimentSettingsDto extends Model
{
    /**
     * @param array<int, string> $actions
     * @param array<int, mixed> $fields
     * @param array<int, array<string, int|string>> $notifications
     */
    public function __construct(
        public readonly array $actions,
        public readonly array $fields,
        public readonly array $notifications,
    ) {
        parent::__construct();
    }
}

<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Experiment;
use Illuminate\Database\Eloquent\Collection;

class ExperimentTransformer
{
    /**
     * @param Experiment $experiment
     * @return array<string, string>
     */
    public function transform(Experiment $experiment): array
    {
        return [
            'id' => $experiment->id,
            'uuid' => $experiment->uuid,
            'name' => $experiment->name,
            'createdAt' => $experiment->createdAt,
        ];
    }

    /**
     * @param Collection<Experiment> $collection
     * @return array<array<string, string>>
     */
    public function transformMulti(Collection $collection): array
    {
        $experiments = [];
        foreach ($collection as $experiment) {
            $experiments[] = $this->transform($experiment);
        }

        return $experiments;
    }
}

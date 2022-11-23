<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(random_int(1, 3), true),
            'uuid' => $this->faker->uuid,
            'description' => $this->faker->sentence,
            'is_public' => random_int(0, 1) === 1,
        ];
    }
}

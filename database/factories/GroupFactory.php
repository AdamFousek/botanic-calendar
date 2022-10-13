<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->title,
            'uuid' => $this->faker->uuid,
            'description' => $this->faker->sentence,
            'is_public' => random_int(0,1) === 1,
            'user_id' => self::factoryForModel(User::class),
        ];
    }
}

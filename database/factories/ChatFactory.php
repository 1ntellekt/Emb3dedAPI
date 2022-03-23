<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'download_first' => false,
            'download_second' => false,
            'user_id_first'  => $this->faker->numberBetween(1,4),
            'user_id_second' => $this->faker->numberBetween(5,9),
        ];
    }
}

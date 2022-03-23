<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News_item>
 */
class News_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(50),
            'user_id' => $this->faker->numberBetween(1,7),
            'img_url' => Str::random(5).'.jpg',
            'tag' => $this->faker->text(10),
        ];
    }
}

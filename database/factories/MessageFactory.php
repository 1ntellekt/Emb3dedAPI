<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'text_msg' => $this->faker->text(30),
            'img_msg' => null,
            'file_msg' => null,
            'file_3d_msg' => null,
            'user_id_sender' => $this->faker->numberBetween(1,4),
            'user_id_recepient' => $this->faker->numberBetween(5,9),
            'chat_id' => $this->faker->numberBetween(1,5),
        ];
    }
}

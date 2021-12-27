<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'content' => $this->faker->text(200),
            'author_id' => User::query()
                ->where("id", $this->faker->randomElement([2, 4, 6, 8, 10]))
                ->first()
                ->id,
        ];
    }
}

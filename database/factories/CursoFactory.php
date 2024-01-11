<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->text(15),
            'img' => 'images/basico.jpg',
            'desc' => fake()->paragraph(),
            'duration' => fake()->randomNumber(2),
            'real_price' => fake()->randomNumber(1),
            'promotion' => fake()->randomNumber(1),
            'promotion_price' => fake()->randomNumber(1),
            'visible' => fake()->boolean(),
            'release_date' => fake()->date(),
            'category_id' => fake()->numberBetween(1, 50),
            'user_id' => 1
        ];
    }
}

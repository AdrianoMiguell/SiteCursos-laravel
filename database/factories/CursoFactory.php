<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $name_curso = fake()->text(15);

        return [
            'name' => $name_curso,
            'img' => 'images/basico.jpg',
            'desc' => fake()->paragraph(),
            'duration' => fake()->numberBetween(0, 3500),
            'price_in_cents' => fake()->numberBetween(0, 50000),
            'promotion' => fake()->randomFloat(2, 0, 1),
            'visible' => fake()->boolean(),
            'release_date' => fake()->date(),
            'slug' => Str::slug($name_curso) . '-' . uniqid(),
            'category_id' => fake()->numberBetween(1, 50),
            'user_id' => 1
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conteudo>
 */

class ConteudoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static $order = 0;

    public function definition()
    {

        self::$order++;

        $video_id = (self::$order) % 2 == 0 ? fake()->numberBetween(7, 50) : null;
        $slide_id = (self::$order) % 2 == 1 ? fake()->numberBetween(7, 50) : null;

        return [
            'type' => fake()->numberBetween(1, 4),
            'video_id' => $video_id,
            'slide_id' => $slide_id,
            'modulo_id' => fake()->numberBetween(4, 50),
            'curso_id' => fake()->numberBetween(2, 100),
        ];
    }
}

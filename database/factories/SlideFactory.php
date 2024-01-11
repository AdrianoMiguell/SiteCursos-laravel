<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(25),
            'text' => fake()->paragraph(),
            'link' => '<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vS4UsvzAD0uXulgJCRMUOTm39ONjSp76mW74dxcN8YZRH4DLrHjN40-za19gDQh1P7F7ByaRERgSuCk/embed?start=true&loop=false&delayms=10000" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>',
        ];
    }
}

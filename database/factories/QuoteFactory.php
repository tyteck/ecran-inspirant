<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class QuoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'text' => fake()->sentences(3, asText: true),
            'category_id' => Category::factory(),
        ];
    }
}

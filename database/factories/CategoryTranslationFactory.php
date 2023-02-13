<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryTranslation>
 */
class CategoryTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => function () {
                return Category::factory()->create()->id;
            },
            'language' => $this->faker->randomElement(['pl', 'en', 'de', 'fr']),
            'name' => $this->faker->word,
        ];
    }
}

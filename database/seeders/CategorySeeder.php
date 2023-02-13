<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryId = Category::factory()->create()->id;
        CategoryTranslation::factory()->create([
            'category_id' => $categoryId,
            'language' => 'pl',
            'name' => 'Usługi',
        ]);
        CategoryTranslation::factory()->create([
            'category_id' => $categoryId,
            'language' => 'en',
            'name' => 'Service',
        ]);

        CategoryTranslation::factory()->create([
            'category_id' => $categoryId,
            'language' => 'de',
            'name' => 'Dienstleistungen',
        ]);

        CategoryTranslation::factory()->create([
            'category_id' => $categoryId,
            'language' => 'fr',
            'name' => 'Prestations de service',
        ]);
    }
}

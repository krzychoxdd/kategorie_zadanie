<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Events\CategoryCreated;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Repositories\CategoryRepository;

class CategoryControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_not_existing_language()
    {
        $categoryId = Category::factory()->create()->id;
        CategoryTranslation::factory()->create([
            'category_id' => $categoryId,
            'language' => 'fr',
        ]);

        CategoryTranslation::factory()->create([
            'category_id' => $categoryId,
            'language' => 'de',
        ]);

        $response = $this->withHeaders([
            'locale' => 'pl',
        ])->get('/categories/list');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => []]);
    }

    public function test_list_categories()
    {
        CategoryTranslation::factory()->count(4)->create([
            'category_id' => Category::factory()->create()->id
        ]);

        $response = $this->withHeaders([
            'locale' => 'pl',
        ])->get('/categories/list');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [ ['id','name'],]]);
    }

    public function test_create_categories()
    {
        Event::fake([CategoryCreated::class]);

        $response  = $this->withHeaders([
            'locale' => 'pl',
        ])->postJson('/categories/create', [
            'translations' => [
                ['language' => 'pl', 'name' => 'Usługi'],
                ['language' => 'en', 'name' => 'Services'],
                ['language' => 'de', 'name' => 'Dienstleistungen'],
                ['language' => 'fr', 'name' => 'Prestations de service'],
            ],
        ]);

        $response->assertStatus(201);

        $data = [
                'data' => [
                'translations' => [
                    ['name' => 'Usługi', 'language' => 'pl'],
                    ['name' => 'Services', 'language' => 'en'],
                    ['name' => 'Dienstleistungen', 'language' => 'de'],
                    ['name' => 'Prestations de service', 'language' => 'fr'], 
                ],
            ],
        ];
        $response->assertJson($data);

        Event::assertDispatched(CategoryCreated::class);
    }

    public function test_create_unavailable_language()
    {
        Event::fake([CategoryCreated::class]);

        $response  = $this->withHeaders([
            'locale' => 'pl',
        ])->postJson('/categories/create', [
            'translations' => [
                ['language' => 'foo', 'name' => 'Bar'],
                ['language' => 'bar', 'name' => 'Foo'],
            ],
        ]);

        $response->assertStatus(422);

        Event::assertNotDispatched(CategoryCreated::class);

        $response->assertJsonValidationErrors('translations.0.language');
    }
}

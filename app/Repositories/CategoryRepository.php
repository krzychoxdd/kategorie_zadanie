<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function getCategories(string $locale) :Collection
    {
        return Category::with('translations')->whereHas('translations', function ($query) use ($locale) {
            $query->where('language', $locale);
        })->get();
    }

    public function createCategory($translationsData)
    {
        $category = new Category();
        $category->save();
    
        foreach ($translationsData as $singleTranslation) {
            $translation = new CategoryTranslation();
            $translation->category_id = $category->id;
            $translation->language = $singleTranslation['language'];
            $translation->name = $singleTranslation['name'];
            $translation->save();
        }
    
        return $category;
    }
}

<?php
 
namespace App\Http\Controllers;

use App\Events\CategoryCreated;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Resources\CategoryCreatedResource;
use App\Repositories\CategoryRepository;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository; 

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Action to get list of categories
     */
    public function list()
    {
        $categories = $this->categoryRepository->getCategories(app()->getLocale());
        
        return CategoryResource::collection($categories);
    }

    /**
     * Action for creating new category
     */
    public function create(CategoryCreateRequest $request)
    {
        $category = $this->categoryRepository->createCategory($request->input('translations'));

        event(new CategoryCreated($category));

        return new CategoryCreatedResource($category);
    }
}
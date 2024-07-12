<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = new CategoryResource(Category::create($request->all()));
        Category::setPopularCategories();
        return [
            'message' => 'Category created',
            'data' => $data
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        Category::setPopularCategories();
        return [
            'message' => 'Category updated',
            'data' => new CategoryResource($category)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (count($category->posts)) {
            return response()->json([
                'message' => 'Error! Selected category belongs to some post(s)'
            ]);
        }

        $category->delete();
        Category::setPopularCategories();
        return response()->json([
            'message' => 'Category deleted'
        ]);
    }
}

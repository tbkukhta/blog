<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query();
        if (request('search')) {
            $categories = $categories->search('title', request('search'));
        }

        return view('admin.categories.' . (request()->ajax() ? 'paginate' : 'index'), [
            'categories' => $categories->paginate(env('PAGINATION_COUNT'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        Category::setPopularCategories();

        return redirect()->route('admin.categories.index')->with('success', 'Category was added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $category->update($request->all());
        Category::setPopularCategories();

        return redirect()->route('admin.categories.index')->with('success', 'Category was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        if (count($category->posts)) {
            return redirect()->route('admin.categories.index')->with('error', 'Error! Selected category belongs to some post(s)');
        }

        $category->delete();
        Category::setPopularCategories();

        return redirect()->route('admin.categories.index')->with('success', 'Category was deleted');
    }
}

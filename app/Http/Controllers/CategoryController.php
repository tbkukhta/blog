<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('created_at', 'desc')->paginate(env('PAGINATION_COUNT'));
        return view('categories.' . (request()->ajax() ? 'paginate' : 'show'), compact('category', 'posts'));
    }
}

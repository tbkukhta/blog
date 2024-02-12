<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search(['title', 'description', 'content', 'category', 'tags'], $request->search)
            ->with('category')->paginate(env('PAGINATION_COUNT'));
        return view('search.' . ($request->ajax() ? 'paginate' : 'index'), compact('posts'));
    }
}

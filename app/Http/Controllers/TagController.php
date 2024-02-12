<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->with('category')->orderBy('created_at', 'desc')->paginate(env('PAGINATION_COUNT'));
        return view('tags.' . (request()->ajax() ? 'paginate' : 'show'), compact('tag', 'posts'));
    }
}

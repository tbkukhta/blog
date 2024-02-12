<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'tags');
        if (request('search')) {
            $posts = $posts->search(['title', 'description', 'content', 'status'], request('search'));
        }

        return view('admin.posts.' . (request()->ajax() ? 'paginate' : 'index'), [
            'posts' => $posts->paginate(env('PAGINATION_COUNT'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        if (($image = Post::uploadImage($request)) !== false) {
            $data['thumbnail'] = $image;
        }
        $post = Post::create($data);
        $post->tags()->sync($request->tags);
        Post::setPopularPosts();

        return redirect()->route('admin.posts.index')->with('success', 'Post was added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $data = $request->all();
        if (($image = Post::uploadImage($request, $post->thumbnail)) !== false) {
            $data['thumbnail'] = $image;
        }
        $post->update($data);
        $post->tags()->sync($request->tags);
        Post::setPopularPosts();

        return redirect()->route('admin.posts.index')->with('success', 'Post was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if (count($post->comments)) {
            return redirect()->route('admin.posts.index')->with('error', 'Error! Selected post has active comment(s)');
        }

        $post->tags()->sync([]);
        Post::deleteImage($post->thumbnail);
        $post->delete();
        Post::setPopularPosts();

        return redirect()->route('admin.posts.index')->with('success', 'Post was deleted');
    }
}

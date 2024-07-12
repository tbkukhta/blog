<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::with('category')->paginate(env('PAGINATION_COUNT')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        if (!empty($request->tags)) {
            if (is_array($request->tags) && empty(array_diff($request->tags, Tag::pluck('id')->toArray()))) {
                $post = Post::create($request->all());
                $post->tags()->sync($request->tags);
            } else {
                return [
                    'message' => 'Error! Tags value must be an array of existing ids from tags table',
                ];
            }
        } else {
            $post = Post::create($request->all());
        }

        Post::setPopularPosts();
        return [
            'message' => 'Post created',
            'data' => new PostResource($post)
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        if (!empty($request->tags)) {
            if (is_array($request->tags) && empty(array_diff($request->tags, Tag::pluck('id')->toArray()))) {
                $post->tags()->sync($request->tags);
            } else {
                return [
                    'message' => 'Error! Tags value must be an array of existing ids from tags table',
                ];
            }
        }

        $post->update($request->all());
        Post::setPopularPosts();
        return [
            'message' => 'Post updated',
            'data' => new PostResource($post)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (count($post->comments)) {
            return response()->json([
                'message' => 'Error! Selected post has active comment(s)'
            ]);
        }

        $post->tags()->sync([]);
        Post::deleteImage($post->thumbnail);
        $post->delete();
        Post::setPopularPosts();

        return response()->json([
            'message' => 'Post deleted'
        ]);
    }
}

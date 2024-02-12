<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::active()->with('category')->orderBy('created_at', 'desc')->paginate(env('PAGINATION_COUNT'));
        if (request()->ajax()) {
            return view('posts.paginate', compact('posts'));
        }
        $advert = Advert::getAdvert(Advert::ADVERT_MAIN);
        return view('posts.index', compact('posts', 'advert'));
    }

    public function show(string $slug)
    {
        if (request()->ajax()) {
            $comments = Comment::whereHas('post', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->active()->receive();
            return view('posts.comments', compact('comments'));
        }
        $post = Post::active()->where('slug', $slug)->withCount('comments')->firstOrFail();
        if ($post->comments_count) {
            $comments = $post->comments()->receive();
        }
        $post->views++;
        $post->update();
        return view('posts.show', ['post' => $post, 'comments' => $comments ?? null]);
    }

    public function comment(Request $request, int $id)
    {
        if ($request->ajax()) {
            Comment::create([
                'content' => $request->comment,
                'post_id' => $id,
                'user_id' => auth()->user()->id,
                'status' => Comment::STATUS_MODERATION,
            ]);
            return true;
        }
        abort(404);
    }
}

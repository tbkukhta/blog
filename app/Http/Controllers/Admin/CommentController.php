<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::query();
        if (request('search')) {
            $comments = $comments->search(['content', 'post', 'user', 'status'], request('search'));
        }
        $comments = $comments->orderBy('created_at', 'desc')->paginate(env('PAGINATION_COUNT'));

        return view('admin.comments.' . (request()->ajax() ? 'paginate' : 'index'), compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::pluck('title', 'id')->all();
        $users = User::pluck('name', 'id')->all();

        return view('admin.comments.create', compact('posts', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        Comment::create($request->all());

        return redirect()->route('admin.comments.index')->with('success', 'Comment was added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $comment = Comment::find($id);
        $posts = Post::pluck('title', 'id')->all();
        $users = User::pluck('name', 'id')->all();

        return view('admin.comments.edit', compact('comment', 'posts', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, int $id)
    {
        $comment = Comment::find($id);
        $comment->update($request->all());

        return redirect()->route('admin.comments.index')->with('success', 'Comment was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Comment::destroy($id);

        return redirect()->route('admin.comments.index')->with('success', 'Comment was deleted');
    }
}

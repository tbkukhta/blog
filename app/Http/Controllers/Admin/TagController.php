<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::query();
        if (request('search')) {
            $tags = $tags->search('title', request('search'));
        }

        return view('admin.tags.' . (request()->ajax() ? 'paginate' : 'index'), [
            'tags' => $tags->paginate(env('PAGINATION_COUNT'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->all());
        Tag::setPopularTags();

        return redirect()->route('admin.tags.index')->with('success', 'Tag was added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $tag->update($request->all());
        Tag::setPopularTags();

        return redirect()->route('admin.tags.index')->with('success', 'Tag was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        if (count($tag->posts)) {
            return redirect()->route('admin.tags.index')->with('error', 'Error! Selected tag belongs to some post(s)');
        }

        $tag->delete();
        Tag::setPopularTags();

        return redirect()->route('admin.tags.index')->with('success', 'Tag was deleted');
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\TagRequest;
use App\Http\Resources\V1\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TagResource::collection(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = new TagResource(Tag::create($request->all()));
        Tag::setPopularTags();
        return [
            'message' => 'Tag created',
            'data' => $data
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->all());
        Tag::setPopularTags();
        return [
            'message' => 'Tag updated',
            'data' => new TagResource($tag)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if (count($tag->posts)) {
            return response()->json([
                'message' => 'Error! Selected tag belongs to some post(s)'
            ]);
        }

        $tag->delete();
        Tag::setPopularTags();
        return response()->json([
            'message' => 'Tag deleted'
        ]);
    }
}

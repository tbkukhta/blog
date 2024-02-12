<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertRequest;
use App\Models\Advert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adverts = Advert::query();
        if (request('search')) {
            $adverts = $adverts->search(['title', 'description', 'link', 'block'], request('search'));
        }
        $adverts = $adverts->orderBy('block')->paginate(env('PAGINATION_COUNT'));

        return view('admin.adverts.' . (request()->ajax() ? 'paginate' : 'index'), compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adverts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvertRequest $request)
    {
        $data = $request->all();
        if (($image = Advert::uploadImage($request)) !== false) {
            $data['image'] = $image;
        }
        $advert = Advert::create($data);

        if ($advert->status == Advert::STATUS_ACTIVE) {
            Cache::put("advert{$advert->block}", $advert);
        }

        return redirect()->route('admin.adverts.index')->with('success', 'Advert was added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $advert = Advert::find($id);

        return view('admin.adverts.edit', compact('advert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $advert = Advert::find($id);

        if (!$request->hasFile('image') && $advert->image) {
            $request->validate(['link' => 'nullable|url'], attributes: ['link' => 'Link']);
        } else {
            $request->validate(AdvertRequest::getRules(), AdvertRequest::getMessages(), AdvertRequest::getAttributes());
        }

        $data = $request->all();
        if (($image = Advert::uploadImage($request, $advert->image)) !== false) {
            $data['image'] = $image;
        }
        $advert->updated_at = Carbon::now();
        $advert->update($data);

        if ($advert->status == Advert::STATUS_ACTIVE) {
            Cache::put("advert{$advert->block}", $advert);
        }

        return redirect()->route('admin.adverts.index')->with('success', 'Advert was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $advert = Advert::find($id);

        if (
            $advert->status == Advert::STATUS_ACTIVE
            && $advert->id == Advert::orderBy('updated_at','desc')->first()->id
        ) {
            Cache::forget("advert{$advert->block}");
        }

        Advert::deleteImage($advert->image);
        $advert->delete();

        return redirect()->route('admin.adverts.index')->with('success', 'Advert was deleted');
    }
}

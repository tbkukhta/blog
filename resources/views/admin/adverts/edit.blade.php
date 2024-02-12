@extends('admin.layouts.main')

@section('title', 'Edit advert')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $advert->title }}</h3>
                        </div>
                        <form method="post" action="{{ route('admin.adverts.update', $advert->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" value="{{ old('title') ?? $advert->title }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Description">{{ old('description') ?? $advert->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Link" value="{{ old('link') ?? $advert->link }}">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="block">Block</label>
                                    <select class="form-control @error('block') is-invalid @enderror" id="block" name="block">
                                        <option value="1" @if((old('block') ?? $advert->block) == 1) selected @endif>Main page</option>
                                        <option value="2" @if((old('block') ?? $advert->block) == 2) selected @endif>Sidebar 1st</option>
                                        <option value="3" @if((old('block') ?? $advert->block) == 3) selected @endif>Sidebar 2nd</option>
                                    </select>
                                    @error('block')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="0" @if((old('status') ?? $advert->status) == 0) selected @endif>Disabled</option>
                                        <option value="1" @if((old('status') ?? $advert->status) == 1) selected @endif>Active</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail" id="thumbnail-label">Image</label>
                                    @if($advert->image)
                                        <div id="image">
                                            <div class="mb-2">
                                                <img class="img-thumbnail" src="{{ asset("uploads/{$advert->image}") }}" alt="" width="300" height="300">
                                            </div>
                                            <div class="mb-2">
                                                <button class="btn btn-danger" id="delete-image">Delete</button>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file @error('image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="thumbnail" name="image" title="{{ $title = $advert->image ? substr($advert->image, 18) : 'Choose an image...' }}">
                                            <label class="custom-file-label" for="thumbnail">{{ $title }}</label>
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input name="deleted" type="hidden" value="0">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('admin.layouts.main')

@section('title', 'Edit post')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/post.css') }}">
@endsection

@php /* @var App\Models\Post $post */ @endphp

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $post->title }}</h3>
                        </div>
                        <form method="post" action="{{ route('admin.posts.update', $post->slug) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ?? $post->title }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description') ?? $post->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8">{{ old('content') ?? $post->content }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}" @if($key == (old('category_id') ?? $post->category_id)) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select class="select2" id="tags" name="tags[]" multiple="multiple" data-placeholder="Select tags..." style="width: 100%;">
                                        @foreach($tags as $key => $value)
                                            <option value="{{ $key }}" @if(in_array($key, old('tags') ?? $post->tags->pluck('id')->all())) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail" id="thumbnail-label">Image</label>
                                    @if($post->thumbnail)
                                        <div id="image">
                                            <div class="mb-2">
                                                <img class="img-thumbnail" src="{{ asset("uploads/{$post->thumbnail}") }}" alt="" width="500">
                                            </div>
                                            <div class="mb-2">
                                                <button class="btn btn-danger" id="delete-image">Delete</button>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file @error('thumbnail') is-invalid @enderror">
                                            <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" title="{{ $title = $post->thumbnail ? substr($post->thumbnail, 18) : 'Choose an image...' }}">
                                            <label class="custom-file-label" for="thumbnail">{{ $title }}</label>
                                        </div>
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input name="deleted" type="hidden" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="0" @if((old('status') ?? $post->status) == 0) selected @endif>Disabled</option>
                                        <option value="1" @if((old('status') ?? $post->status) == 1) selected @endif>Active</option>
                                    </select>
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

@section('scripts')
    <script src="{{ asset('assets/admin/ckeditor/build/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('assets/admin/js/post.js') }}"></script>
@endsection

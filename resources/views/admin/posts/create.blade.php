@extends('admin.layouts.main')

@section('title', 'Create post')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/post.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add new post</h3>
                        </div>
                        <form method="post" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" placeholder="Description...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8" placeholder="Content...">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        <option value="{{ null }}">Select category...</option>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}" @if(old('category_id') == $key) selected @endif>{{ $value }}</option>
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
                                            <option value="{{ $key }}" @if(is_array(old('tags')) && in_array($key, old('tags'))) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail" id="thumbnail-label">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file @error('thumbnail') is-invalid @enderror">
                                            <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" title="Choose an image...">
                                            <label class="custom-file-label" for="thumbnail">Choose an image...</label>
                                        </div>
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input name="deleted" type="hidden" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="{{ null }}">Select status...</option>
                                        <option value="0" @if(old('status') === '0') selected @endif>Disabled</option>
                                        <option value="1" @if(old('status') === '1') selected @endif>Active</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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

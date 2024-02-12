@extends('admin.layouts.main')

@section('title', 'Create advert')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add new advert</h3>
                        </div>
                        <form method="post" action="{{ route('admin.adverts.store') }}" enctype="multipart/form-data">
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
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Link" value="{{ old('link') }}">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="block">Block</label>
                                    <select class="form-control @error('block') is-invalid @enderror" id="block" name="block">
                                        <option value="{{ null }}">Select block...</option>
                                        <option value="1" @if(old('block') === '1') selected @endif>Main page</option>
                                        <option value="2" @if(old('block') === '2') selected @endif>Sidebar 1st</option>
                                        <option value="3" @if(old('block') === '3') selected @endif>Sidebar 2nd</option>
                                    </select>
                                    @error('block')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="{{ null }}">Select status...</option>
                                        <option value="0" @if(old('status') === '0') selected @endif>Disabled</option>
                                        <option value="1" @if(old('status') === '1') selected @endif>Active</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail" id="thumbnail-label">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file @error('image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="thumbnail" name="image" title="Choose an image...">
                                            <label class="custom-file-label" for="thumbnail">Choose an image...</label>
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

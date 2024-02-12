@extends('admin.layouts.main')

@section('title', 'Create comment')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add new comment</h3>
                        </div>
                        <form method="post" action="{{ route('admin.comments.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4" placeholder="Content...">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="post_id">Post</label>
                                    <select class="form-control @error('post_id') is-invalid @enderror" id="post_id" name="post_id">
                                        <option value="{{ null }}">Select post...</option>
                                        @foreach($posts as $key => $value)
                                            <option value="{{ $key }}" @if(old('post_id') == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('post_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="user_id">Author</label>
                                    <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                        <option value="{{ null }}">Select author...</option>
                                        @foreach($users as $key => $value)
                                            <option value="{{ $key }}" @if(old('user_id') == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="{{ null }}">Select status...</option>
                                        <option value="0" @if(old('status') === '0') selected @endif>Disabled</option>
                                        <option value="1" @if(old('status') === '1') selected @endif>Active</option>
                                        <option value="2" @if(old('status') === '2') selected @endif>Moderation</option>
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

@extends('admin.layouts.main')

@section('title', 'Add user')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add new user</h3>
                        </div>
                        <form method="post" action="{{ route('admin.users.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="question">Security question</label>
                                    <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}">
                                    @error('question')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="answer">Security answer</label>
                                    <input type="text" class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" value="{{ old('answer') }}">
                                    @error('answer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail" id="thumbnail-label">Avatar</label>
                                    <div class="input-group">
                                        <div class="custom-file @error('avatar') is-invalid @enderror">
                                            <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" id="thumbnail" name="avatar" title="Choose an image...">
                                            <label class="custom-file-label" for="avatar">Choose an image...</label>
                                        </div>
                                        @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input name="deleted" type="hidden" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="is_admin">Role</label>
                                    <select class="form-control @error('is_admin') is-invalid @enderror" id="is_admin" name="is_admin">
                                        <option value="{{ null }}">Choose role...</option>
                                        <option value="0" @if(old('is_admin') === '0') selected @endif>User</option>
                                        <option value="1" @if(old('is_admin') === '1') selected @endif>Admin</option>
                                    </select>
                                    @error('is_admin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="{{ null }}">Choose status...</option>
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

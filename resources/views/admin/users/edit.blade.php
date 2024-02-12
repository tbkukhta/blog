@extends('admin.layouts.main')

@section('title', 'Edit user')

@php /* @var App\Models\User $user */ @endphp

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $user->name }}</h3>
                        </div>
                        <form method="post" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $user->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?? $user->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Leave empty to keep unchanged">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="question">Security question</label>
                                    <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') ?? $user->question }}" placeholder="Leave empty to skip this option">
                                    @error('question')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="answer">Security answer</label>
                                    <input type="text" class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" value="{{ old('answer') ?? $user->answer }}" placeholder="Leave empty to skip this option">
                                    @error('answer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail" id="thumbnail-label">Avatar</label>
                                    @if($user->avatar)
                                        <div id="image">
                                            <div class="mb-2">
                                                <img class="img-thumbnail" src="{{ asset("uploads/{$user->avatar}") }}" alt="avatar" width="200">
                                            </div>
                                            <div class="mb-2">
                                                <button class="btn btn-danger" id="delete-image">Delete</button>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file @error('avatar') is-invalid @enderror">
                                            <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" id="thumbnail" name="avatar" title="{{ $title = $user->avatar ? substr($user->avatar, 18) : 'Choose an image...' }}">
                                            <label class="custom-file-label" for="thumbnail">{{ $title }}</label>
                                        </div>
                                        @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input name="deleted" type="hidden" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="is_admin">Role</label>
                                    <select class="form-control" id="is_admin" name="is_admin">
                                        <option value="0" @if(!$user->is_admin) selected @endif>User</option>
                                        <option value="1" @if($user->is_admin) selected @endif>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="0" @if(!$user->status) selected @endif>Disabled</option>
                                        <option value="1" @if($user->status) selected @endif>Active</option>
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

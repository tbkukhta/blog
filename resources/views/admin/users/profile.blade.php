@extends('.admin.layouts.user')

@section('title', 'Profile')

@php /* @var App\Models\User $user */ @endphp

@section('content')
    <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <label for="name" class="input-group">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3">
            <label for="email" class="input-group">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3 password">
            <label for="password" class="input-group">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave empty to keep unchanged">
            <div class="input-group-append">
                <div class="input-group-text">
                    <a href="#" title="Show password">
                        <span class="fas fa-lock"></span>
                    </a>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3 password">
            <label for="password_confirmation" class="input-group">Password confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            <div class="input-group-append">
                <div class="input-group-text">
                    <a href="#" title="Show password">
                        <span class="fas fa-lock"></span>
                    </a>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3">
            <label for="question" class="input-group">Security question</label>
            <input type="text" class="form-control" id="question" name="question" placeholder="Leave empty to skip this option" value="{{ $user->question }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-question"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3">
            <label for="answer" class="input-group">Security answer</label>
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Leave empty to skip this option" value="{{ $user->answer }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-check"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3">
            <label for="thumbnail" id="thumbnail-label" class="input-group">Avatar</label>
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
                <div class="custom-file">
                    <input type="file" class="custom-file-input form-control" id="thumbnail" name="avatar" title="{{ $title = $user->avatar ? substr($user->avatar, 18) : 'Choose an image...' }}">
                    <label class="custom-file-label" for="thumbnail">{{ $title }}</label>
                </div>
                <div class="invalid-feedback"></div>
            </div>
            <input name="deleted" type="hidden" value="0">
        </div>
        <div class="row" style="margin-bottom: -2rem">
            <div class="col-4 mt-2">
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </div>
        <div class="offset-8"><a href="{{ route('home') }}">Home page</a></div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).on('change', '#thumbnail', function () {
            $(this).attr('title', this.files[0].name);
            $(this).next('label').text(this.files[0].name);
            $('#image').remove();
            $('#thumbnail-label').after('<div id="image">' +
                '<div class="mb-2">' +
                '<button class="btn btn-danger" id="delete-image">Delete</button>' +
                '</div>' +
                '</div>');
        });
        $(document).on('click', '#delete-image', function (e) {
            e.preventDefault();
            let $thumbnail = $('#thumbnail');
            $thumbnail.attr('title', 'Choose an image...');
            $thumbnail.val('');
            $('[name="deleted"]').val(1);
            $thumbnail.next('label').text('Choose an image...');
            $('#image').remove();
        });
    </script>
@endsection

@extends('.admin.layouts.user')

@section('title', 'Registration')

@section('content')
    <form action="{{ route('register.store') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" title="Name">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" title="E-mail">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="input-group mb-3 password">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" title="Password">
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
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation" title="Password confirmation">
            <div class="input-group-append">
                <div class="input-group-text">
                    <a href="#" title="Show password">
                        <span class="fas fa-lock"></span>
                    </a>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="row">
            <div class="col-4 offset-8">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
    </form>
    <div class="mt-2"><a href="{{ route('login.create') }}" title="Login">Already have an account?</a></div>
    <div class="mt-2"><a href="{{ route('home') }}">Home page</a></div>
@endsection

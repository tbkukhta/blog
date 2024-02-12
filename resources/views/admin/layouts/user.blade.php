<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('assets/site/images/blog-favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/user.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <b>@yield('title')</b>
    </div>
    <div class="card" @if(Route::is('profile')) style="margin-bottom: 10px" @endif>
        <div class="card-body register-card-body">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('assets/admin/js/user.js') }}"></script>
@yield('scripts')
</body>
</html>

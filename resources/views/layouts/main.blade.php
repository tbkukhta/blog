<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/site/images/blog-favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/site/css/site.css') }}">
</head>
<body>

<div id="wrapper">
    @include('layouts.navbar')

    @yield('header')

    <section class="section lb @if(Route::is('post.show')) m3rem @endif">
        <div class="container">
            @if(session('success'))
                <div class="content-wrapper">
                    <div class="container mt-2 d-inline-flex">
                        <div class="row">
                            <div class="alert alert-success">
                                {{ session('success') }}
                                <button type="button" class="close pl-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    @yield('content')
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        @include('layouts.footer')
    </footer>

    <div class="dmtop">Scroll to Top</div>
</div>

<script src="{{ asset('assets/site/js/site.js') }}"></script>

@yield('scripts')

</body>
</html>

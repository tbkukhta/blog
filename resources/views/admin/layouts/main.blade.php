<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | @yield('title')</title>
    <link rel="icon" href="{{ asset('assets/admin/img/AdminLTELogo.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapi@s.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" data-enable-remember="true" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            @if(in_array($folder = (explode('.', request()->route()->getAction()['as'])[1]),
                ['posts', 'categories', 'tags', 'adverts', 'users', 'comments']
            ))
                <li class="nav-item">
                    <a href="#" class="nav-link" data-widget="navbar-search" role="button" title="Search">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" method="get" action="{{ route('admin.search') }}">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search in {{ $folder }}" aria-label="Search" required>
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="submit" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input name="folder" type="hidden" value="{{ $folder }}">
                        </form>
                    </div>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="brand-link">
            <img src="{{ asset('assets/admin/img/AdminLTELogo.png') }}" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8" title="Admin panel">
            <a href="{{ route('home') }}" target="_blank" style="color: rgba(255,255,255,.8)">
                <span class="brand-text font-weight-light">Go to site</span>
            </a>
        </div>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ auth()->user()->getImage() }}" class="img-circle elevation-2" alt="avatar" title="Avatar">
                </div>
                <div class="info">
                    <a href="{{ route('admin.users.edit', auth()->user()->id) }}" class="d-block" title="Edit profile">
                        {{ auth()->user()->name }}
                    </a>
                </div>
                <div class="info">
                    <a href="{{ route('logout') }}" class="fa fa-sign-out-alt" title="Logout"></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Main</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>Categories<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Tags<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.tags.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tags list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.tags.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New tag</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Posts<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Posts list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New post</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-audio-description"></i>
                            <p>Adverts<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.adverts.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Adverts list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.adverts.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New advert</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Comments<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.comments.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Comments list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.comments.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New comment</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users list</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New user</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        @if(session('success'))
            <div class="container mt-2 d-inline-flex">
                <div class="row">
                    <div class="col-12">
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

        @if(session('error'))
            <div class="container mt-2 d-inline-flex">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            {{ session('error') }}
                            <button type="button" class="close pl-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                </div>
            </div>
        </section>

        @yield('content')
    </div>

    <footer class="main-footer">
        <strong>Admin panel</strong> &copy; {{ date('Y') }}.
    </footer>
</div>

<script src="{{ asset('assets/admin/js/admin.js') }}"></script>

@yield('scripts')

</body>
</html>

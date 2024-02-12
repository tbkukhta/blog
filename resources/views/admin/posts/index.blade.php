@extends('admin.layouts.main')

@section('title', 'Posts')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(request()->search)
                        Posts containing search request: <b>{{ request()->search }}</b>
                    @else
                        Posts list
                    @endif
                </h3>
                @include('admin.buttons')
            </div>
            <div class="card-body">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mb-3">Add post</a>
                @if(count($posts))
                    <div id="paginate">
                        @include('admin.posts.paginate')
                    </div>
                @else
                    <p>No posts...</p>
                @endif
            </div>
        </div>
    </section>
@endsection

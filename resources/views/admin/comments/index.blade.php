@extends('admin.layouts.main')

@section('title', 'Comments')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(request()->search)
                        Comments containing search request: <b>{{ request()->search }}</b>
                    @else
                        Comments list
                    @endif
                </h3>
                @include('admin.buttons')
            </div>
            <div class="card-body">
                <a href="{{ route('admin.comments.create') }}" class="btn btn-primary mb-3">Add comment</a>
                @if(count($comments))
                    <div id="paginate">
                        @include('admin.comments.paginate')
                    </div>
                @else
                    <p>No comments...</p>
                @endif
            </div>
        </div>
    </section>
@endsection

@extends('admin.layouts.main')

@section('title', 'Tags')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(request()->search)
                        Tags containing search request: <b>{{ request()->search }}</b>
                    @else
                        Tags list
                    @endif
                </h3>
                @include('admin.buttons')
            </div>
            <div class="card-body">
                <a href="{{ route('admin.tags.create') }}" class="btn btn-primary mb-3">Add tag</a>
                @if(count($tags))
                    <div id="paginate">
                        @include('admin.tags.paginate')
                    </div>
                @else
                    <p>No tags...</p>
                @endif
            </div>
        </div>
    </section>
@endsection

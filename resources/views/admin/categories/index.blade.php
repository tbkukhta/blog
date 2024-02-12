@extends('admin.layouts.main')

@section('title', 'Categories')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(request()->search)
                        Categories containing search request: <b>{{ request()->search }}</b>
                    @else
                        Categories list
                    @endif
                </h3>
                @include('admin.buttons')
            </div>
            <div class="card-body">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add category</a>
                @if(count($categories))
                    <div id="paginate">
                        @include('admin.categories.paginate')
                    </div>
                @else
                    <p>No categories...</p>
                @endif
            </div>
        </div>
    </section>
@endsection

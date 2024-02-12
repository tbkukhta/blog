@extends('layouts.alternate')

@section('title', 'Blog | Search')

@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Search results for "{{ request()->search }}"</h2>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Search</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if(count($posts))
        <div id="paginate">
            @include('search.paginate')
        </div>
    @else
        <div class="page-wrapper">
            <div class="blog-custom-build">
                No results...
            </div>
        </div>
        <hr class="invis">
    @endif
@endsection

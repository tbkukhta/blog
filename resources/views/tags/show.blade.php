@extends('layouts.alternate')

@section('title', 'Blog | ' . $tag->title)

@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Tag: {{ $tag->title }}</h2>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $tag->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if(count($posts))
        <div id="paginate">
            @include('tags.paginate')
        </div>
    @endif
@endsection

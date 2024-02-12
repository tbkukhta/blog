@extends('layouts.main')

@section('title', 'Blog | Home')

@section('header')
    <section id="cta" class="section">
        <div class="container">
            @if($advert)
                <div class="row">
                    <div class="col-lg-8 col-md-12 align-self-center">
                        @if($advert->title)
                            <h2>{{ $advert->title }}</h2>
                        @endif
                        @if($advert->description)
                            <p class="lead">{{ $advert->description }}</p>
                        @endif
                        @if($advert->link)
                            <a href="{{ $advert->link }}" target="_blank" class="btn btn-primary">Click here to find out more...</a>
                        @endif
                    </div>
                    @if($advert->image)
                        <div class="col-lg-4 col-md-12 advert">
                            <div class="newsletter-widget text-center align-self-center">
                                <div class="widget">
                                    <div class="banner-spot clearfix">
                                        <div class="banner-img">
                                            <img src="{{ asset("uploads/{$advert->image}") }}" alt="advert" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection

@section('content')
    @if(count($posts))
        <div id="paginate">
            @include('posts.paginate')
        </div>
    @endif
@endsection

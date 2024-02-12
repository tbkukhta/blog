@extends('layouts.main')

@php /* @var App\Models\Post $post */ @endphp

@section('title', 'Blog | ' . $post->title)

@section('content')
    <div class="page-wrapper">
        <div class="blog-title-area">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('category.show', $post->category->slug) }}">
                        {{ $post->category->title }}
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ $post->title }}</li>
            </ol>

            <span class="color-yellow">
                <a href="{{ route('category.show', $post->category->slug) }}">
                    {{ $post->category->title }}
                </a>
            </span>

            <h3>{{ $post->title }}</h3>

            <div class="blog-meta big-meta">
                <small>{{ $post->getDate() }}</small>
                <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
            </div>
        </div>

        <div class="single-post-media">
            <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
        </div>

        <div class="blog-content">{!! $post->content !!}</div>

        @if(count($post->tags))
            <div class="blog-title-area">
                <div class="tag-cloud-single">
                    <span>Tags</span>
                    @foreach($post->tags as $tag)
                        <small>
                            <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->title }}</a>
                        </small>
                    @endforeach
                </div>
            </div>
        @endif

        @if($count = $post->comments_count)
            <hr class="invis1">
            <div class="custombox clearfix">
                <h4 class="small-title">{{ $count }} @if($count > 1) comments @else comment @endif</h4>
                <div id="paginate">
                    @include('posts.comments')
                </div>
            </div>
        @endif

        @auth()
            <hr class="invis1">
            <div class="custombox clearfix">
                <h4 class="small-title">Leave a comment</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="comment-form" class="form-wrapper">
                            <textarea class="form-control" name="comment" placeholder="Your comment" required></textarea>
                            <button type="submit" class="btn btn-primary" role="button">Submit comment</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </div>
@endsection

@auth()
    @section('scripts')
        <script>
            $('#comment-form').submit(function (e) {
                e.preventDefault();
                let $form = $(this);
                $.ajax({
                    type: 'post',
                    data: $form.serialize(),
                    url: '{{ route('post.comment', $post->id) }}',
                    success: function () {
                        $('[name="comment"]').val('');
                        $form.parents('.custombox').prev().before(`<div class="container row mt-5">
                            <div class="alert alert-success">
                                Thank you! Your comment has been submitted for moderation.
                                <button type="button" class="close pl-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>`);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    },
                });
            });
        </script>
    @endsection
@endauth

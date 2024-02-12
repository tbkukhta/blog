<div class="page-wrapper">
    <div class="blog-custom-build">
        @foreach($posts as $post)
            @php /* @var App\Models\Post $post */ @endphp
            <div class="blog-box wow fadeIn">
                <div class="post-media">
                    <a href="{{ route('post.show', $post->slug) }}" title="{{ $post->title }}">
                        <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
                        <div class="hovereffect">
                            <span></span>
                        </div>
                    </a>
                </div>
                <div class="blog-meta big-meta text-center">
                    <h4>
                        <a href="{{ route('post.show', $post->slug) }}" title="{{ $post->title }}">
                            {{ $post->title }}
                        </a>
                    </h4>
                    {!! $post->description !!}
                    <small>
                        <a href="{{ route('category.show', $post->category->slug) }}">
                            {{ $post->category->title }}
                        </a>
                    </small>
                    <small>{{ $post->getDate() }}</small>
                    <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                </div>
            </div>
            <hr class="invis">
        @endforeach
    </div>
</div>

<hr class="invis">

<div class="row">
    <div class="col-md-12">
        <nav aria-label="Page navigation">
            {{ $posts->appends(['search' => request()->search])->links() }}
        </nav>
    </div>
</div>

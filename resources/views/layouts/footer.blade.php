<div class="container">
    <div class="row">
        @if(count($posts))
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular posts</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($posts as $post)
                                @php /* @var App\Models\Post $post */ @endphp
                                <a href="{{ route('post.show', ['slug' => $post->slug]) }}"
                                   class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="{{ $post->getImage() }}" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">{{ $post->title }}</h5>
                                        <small>{{ $post->getDate() }}</small>
                                        <small title="Post views" style="color: #fff !important">
                                            <i class="fa fa-eye"></i> {{ $post->views }}
                                        </small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(count($categories))
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular categories</h2>
                    <div class="link-widget">
                        <ul>
                            @foreach($categories as $tag)
                                <li>
                                    <a href="{{ route('category.show', ['slug' => $tag->slug]) }}">
                                        {{ $tag->title }} <span title="Posts count">({{ $tag->posts_count }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if(count($tags))
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular tags</h2>
                    <div class="link-widget">
                        <ul>
                            @foreach($tags as $tag)
                                <li>
                                    <a href="{{ route('tag.show', ['slug' => $tag->slug]) }}">
                                        {{ $tag->title }} <span title="Posts count">({{ $tag->posts_count }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <br><br><div class="copyright"><a href="{{ route('home') }}">Blog</a> &copy; {{ date('Y') }}.</div>
        </div>
    </div>
</div>

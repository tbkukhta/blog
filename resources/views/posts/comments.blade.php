<div class="row">
    <div class="col-lg-12">
        <div class="comments-list">
            @foreach($comments as $comment)
                @php /* @var App\Models\Comment $comment */ @endphp
                <div class="media">
                    <span class="media-left">
                        <img src="{{ $comment->user->getImage() }}" alt="avatar" class="rounded-circle">
                    </span>
                    <div class="media-body">
                        <h4 class="media-heading user_name">
                            {{ $comment->user->name }}<small>{{ $comment->getDate(true) }}</small>
                        </h4>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <nav aria-label="Page navigation">
                {{ $comments->links() }}
            </nav>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-nowrap">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Post</th>
            <th>Author</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            @php /* @var App\Models\Comment $comment */ @endphp
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->post->title }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->status ? ($comment->status == 1 ? 'Active' : 'Moderation') : 'Disabled' }}</td>
                <td>{{ $comment->created_at }}</td>
                <td>
                    <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-info btn-sm float-left mr-1" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post" class="float-left" title="Delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm deleting')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $comments->appends(['search' => request()->search])->links() }}
</div>

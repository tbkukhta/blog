<div class="table-responsive">
    <table class="table table-bordered table-hover text-nowrap">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Views</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            @php /* @var App\Models\Post $post */ @endphp
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->category->title }}</td>
                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                <td>{{ $post->views }}</td>
                <td>{{ $post->status ? 'Active' : 'Disabled' }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-info btn-sm float-left mr-1" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post" class="float-left" title="Delete">
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
    {{ $posts->appends(['search' => request()->search])->links() }}
</div>

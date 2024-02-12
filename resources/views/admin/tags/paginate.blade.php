<div class="table-responsive">
    <table class="table table-bordered table-hover text-nowrap">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->slug }}</td>
                <td>
                    <a href="{{ route('admin.tags.edit', $tag->slug) }}" class="btn btn-info btn-sm float-left mr-1" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.tags.destroy', $tag->slug) }}" method="post" class="float-left" title="Delete">
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
    {{ $tags->appends(['search' => request()->search])->links() }}
</div>

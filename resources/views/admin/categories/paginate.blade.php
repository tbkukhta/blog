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
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->slug) }}" class="btn btn-info btn-sm float-left mr-1" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="post" class="float-left" title="Delete">
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
    {{ $categories->appends(['search' => request()->search])->links() }}
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-nowrap">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Link</th>
            <th>Block</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($adverts as $advert)
            <tr>
                <td>{{ $advert->id }}</td>
                <td>{{ $advert->title }}</td>
                <td>{{ $advert->description }}</td>
                <td>{{ $advert->link }}</td>
                <td>{{ match ($advert->block) {1 => 'Main page', 2 => 'Sidebar 1st', 3 => 'Sidebar 2nd'} }}</td>
                <td>{{ $advert->status ? 'Active' : 'Disabled' }}</td>
                <td>{{ $advert->updated_at }}</td>
                <td>
                    <a href="{{ route('admin.adverts.edit', $advert->id) }}" class="btn btn-info btn-sm float-left mr-1" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.adverts.destroy', $advert->id) }}" method="post" class="float-left" title="Delete">
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
    {{ $adverts->appends(['search' => request()->search])->links() }}
</div>

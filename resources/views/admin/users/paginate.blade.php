<div class="table-responsive">
    <table class="table table-bordered table-hover text-nowrap">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @php /* @var App\Models\User $user */ @endphp
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                <td>{{ $user->status ? 'Active' : 'Disabled' }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm float-left mr-1" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    @if($user->id == auth()->user()->id)
                        <button class="btn btn-danger btn-sm" title="Cannot delete authenticated user" disabled>
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    @else
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="float-left" title="Delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm deleting')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->appends(['search' => request()->search])->links() }}
</div>

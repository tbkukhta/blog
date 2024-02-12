@extends('admin.layouts.main')

@section('title', 'Users')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(request()->search)
                        Users containing search request: <b>{{ request()->search }}</b>
                    @else
                        Users list
                    @endif
                </h3>
                @include('admin.buttons')
            </div>
            <div class="card-body">
                <a href="{{ route('admin.users.add') }}" class="btn btn-primary mb-3">Add user</a>
                @if(count($users))
                    <div id="paginate">
                        @include('admin.users.paginate')
                    </div>
                @else
                    <p>No users...</p>
                @endif
            </div>
        </div>
    </section>
@endsection

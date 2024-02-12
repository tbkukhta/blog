@extends('admin.layouts.main')

@section('title', 'Main Page')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin panel</h3>
                @include('admin.buttons')
            </div>
            <div class="card-body">
                Admin panel main page
            </div>
        </div>
    </section>
@endsection

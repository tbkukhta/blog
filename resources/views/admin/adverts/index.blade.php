@extends('admin.layouts.main')

@section('title', 'Adverts')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if(request()->search)
                        Adverts containing search request: <b>{{ request()->search }}</b>
                    @else
                        Adverts list
                    @endif
                </h3>
                @include('admin.buttons')
            </div>
            <div class="card-body">
                <a href="{{ route('admin.adverts.create') }}" class="btn btn-primary mb-3">Add advert</a>
                @if(count($adverts))
                    <div id="paginate">
                        @include('admin.adverts.paginate')
                    </div>
                @else
                    <p>No adverts...</p>
                @endif
            </div>
        </div>
    </section>
@endsection

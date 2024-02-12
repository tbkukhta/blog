@extends('errors::minimal')

@section('title', 'Blog | 404')

@section('code', '404 – ' . strtoupper('not found'))

@section('message')
    <a href="{{ route('home') }}" title="Home page">Home</a>
@endsection

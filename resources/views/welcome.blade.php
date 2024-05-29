@extends('layouts.app')

@section('content')
    <h1>Welcome to the Blog</h1>
    <p>There are no posts available at the moment. Please check back later.</p>
    @auth
        <a href="{{ route('posts.create') }}">Create your first post</a>
    @endauth
@endsection

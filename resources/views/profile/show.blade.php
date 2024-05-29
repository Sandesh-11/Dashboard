<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">{{ $user->name }}</h1>

        <h2 class="text-xl font-semibold mb-2">Posts by {{ $user->name }}</h2>
        @if($posts->isEmpty())
            <p>No posts available.</p>
        @else
            <ul>
                @foreach($posts as $post)
                    <li class="border p-2 my-2">
                        <h3 class="text-lg font-bold">{{ $post->title }}</h3>
                        <p>{{ $post->status }}</p>
                        @if($post->photo)
                            <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" class="mt-2 w-full h-auto rounded">
                        @else
                            <p>No photo available.</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

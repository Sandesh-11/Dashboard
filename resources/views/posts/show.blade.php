@extends('layouts.app')

@section('content')
    @if ($post->photo)
        <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" style="max-width: 100%;">
    @endif
    @if ($post->status)
        <p>Status: {{ $post->status }}</p>
    @endif
    <p>By {{ $post->user->name }} at {{ $post->created_at }}</p>

    @auth
        @if (auth()->id() == $post->user_id)
            <a href="{{ route('posts.edit', $post) }}">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif

        <h3>Comments</h3>
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <textarea name="content" required></textarea>
            <button type="submit">Add Comment</button>
        </form>
    @endauth

    @foreach ($post->comments as $comment)
        <div>
            <p>{{ $comment->content }}</p>
            <p>By {{ $comment->user->name }} at {{ $comment->created_at }}</p>
        </div>
    @endforeach
@endsection

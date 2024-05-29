@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <!-- Photo Upload -->
        <div class="mb-4">
            <label for="photo" class="block text-gray-700 font-medium mb-2">Photo</label>
            <input type="file" name="photo" id="photo" accept="image/*" class="w-full border border-gray-300 p-2 rounded">
            @if ($post->photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $post->photo) }}" alt="Current Photo" class="w-full h-auto rounded">
                </div>
            @endif
        </div>

        <!-- Status Input -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
            <input type="text" name="status" id="status" value="{{ $post->status }}" required class="w-full border border-gray-300 p-2 rounded">
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
@endsection

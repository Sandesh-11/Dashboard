@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" accept="image/*" required>
        </div>
        <div>
            <label for="status">Status</label>
            <input type="text" name="status" id="status" required>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection

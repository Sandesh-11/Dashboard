@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <!-- Total Posts -->
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-600 mb-2 flex justify-between">
                Total Posts
                <a href="{{ route('posts.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
                    Posts
                    <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M14.293 9H4a1 1 0 0 0 0 2h10.293l-3.147 3.146a1 1 0 1 0 1.414 1.414l4-4a1 1 0 0 0 0-1.414l-4-4a1 1 0 1 0-1.414 1.414L14.293 9z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="text-3xl font-semibold">{{ $totalPosts }}</div>
        </div>

        <!-- Latest Post -->
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-600 mb-2">Latest Post</div>
            @if($latestPost)
                <a href="{{ route('posts.show', $latestPost->id) }}" class="block">
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full mr-4" src="/storage/{{ $latestPost->photo }}" alt="User Image">
                        <div>
                            <div class="text-gray-900">{{ $latestPost->user->name }}</div>
                            <div class="text-gray-600">{{ $latestPost->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <p class="mt-2">{{ $latestPost->status }}</p>
                </a>
            @else
                <p>No posts yet.</p>
            @endif
        </div>

        <!-- Create Post -->
        <div class="bg-white p-6 rounded shadow">
            <div class="text-gray-600 mb-4 text-lg font-semibold">Create Post</div>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="photo" class="block text-gray-700 font-medium">Photo</label>
                    <div class="relative mt-1">
                        <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="photo" name="photo" onchange="previewFile()">
                        <button type="button" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Choose File</button>
                    </div>
                    <img id="photo-preview" class="mt-2 hidden w-32 h-32 rounded-md object-cover" src="#" alt="Image Preview">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-medium">Status</label>
                    <textarea class="form-control mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" id="status" name="status" rows="3" placeholder="What's on your mind?"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Post</button>
            </form>
        </div>
    </div>

    <!-- Users Information -->
    <div class="bg-white p-6 mt-4 rounded shadow">
        <div class="text-gray-600 mb-4 text-lg font-semibold">Users Information</div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="w-1/3 px-4 py-2 border-b-2 border-gray-300 bg-gray-100 text-left text-sm leading-4 text-gray-600 font-semibold">Name</th>
                    <th class="w-1/3 px-4 py-2 border-b-2 border-gray-300 bg-gray-100 text-left text-sm leading-4 text-gray-600 font-semibold">Email</th>
                    <th class="w-1/3 px-4 py-2 border-b-2 border-gray-300 bg-gray-100 text-left text-sm leading-4 text-gray-600 font-semibold">Total Posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border-t px-4 py-2 text-sm text-gray-700">{{ $user->name }}</td>
                        <td class="border-t px-4 py-2 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="border-t px-4 py-2 text-sm text-gray-700">{{ $user->posts_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript to handle image preview -->
    <script>
        function previewFile() {
            const file = document.getElementById('photo').files[0];
            const preview = document.getElementById('photo-preview');

            const reader = new FileReader();
            reader.addEventListener('load', function () {
                preview.src = reader.result;
                preview.classList.remove('hidden');
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Posts</h1>

    @forelse ($posts as $post)
        <div class="border p-4 rounded shadow mb-4 relative">
            <div class="flex justify-between items-start">
                <h2 class="text-xl font-semibold mb-2">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:text-blue-700">{{ $post->title }}</a>
                </h2>

                <!-- Three-dot menu for authorized users -->
                @auth
                    @if(auth()->id() == $post->user_id)
                        <div class="relative">
                            <button onclick="toggleMenu('menu-{{ $post->id }}')" class="focus:outline-none">
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 7a2 2 0 110-4 2 2 0 010 4zm0 5a2 2 0 110-4 2 2 0 010 4zm0 5a2 2 0 110-4 2 2 0 010 4z"/>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="menu-{{ $post->id }}" x-cloak class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                <a href="{{ route('posts.edit', $post->id) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-200">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
            <h2><b><p class="text-gray-600">{{ $post->status }}</p></b></h2><br>


            @if ($post->photo)
                <div class="flex justify mb-2">
                <div class="w-100 h-100 flex justify-center items-center">
                    <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" class="w-100 h-auto rounded ">
                </div>
                </div>
            @endif
            <p class="text-gray-600">By {{ $post->user->name }} at {{ $post->created_at->format('d M Y, H:i') }}</p>

            <!-- Display Comments -->
            <div class="mt-4">
                <h4 class="text-md font-semibold mb-2">Comments</h4>
                @foreach ($post->comments as $comment)
                    <div class="border-t py-2">
                        <p class="text-gray-600"><strong>{{ $comment->user->name }}</strong> at {{ $comment->created_at->format('d M Y, H:i') }}</p>
                        <p>{{ $comment->content }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Comment Form -->
            <div class="border-t mt-4 pt-4">
                <h4 class="text-md font-semibold mb-2">Add a Comment</h4>
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="comment_{{ $post->id }}" class="block text-gray-700">Comment:</label>
                        <textarea id="comment_{{ $post->id }}" name="comment" rows="3" class="w-full p-2 border rounded" placeholder="Write your comment here..."></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Comment</button>
                </form>
            </div>
        </div>
    @empty
        <p>No posts available.</p>
    @endforelse

    <!-- JavaScript for toggling the menu -->
    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle('hidden');
        }
        document.addEventListener('click', function(event) {
            const menus = document.querySelectorAll('[id^="menu-"]');
            menus.forEach(menu => {
                if (!menu.contains(event.target) && !event.target.closest('[onclick^="toggleMenu"]')) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
@endsection

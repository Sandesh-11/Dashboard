<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('') }}Domain</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .sidebar-open .sidebar {
            transform: translateX(0);
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
    </style>
</head>
<body class="bg-gray-200">
    <div class="container mx-auto p-4">
        <!-- Navigation Bar -->
        <nav class="bg-blue-600 text-white p-4 flex items-center justify-between">
            <div class="flex items-center">
                <button id="menu-toggle" class="focus:outline-none mr-4">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-xl font-semibold">{{ config('') }}Domain</span>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Home</a>
                @auth
                    <a href="{{ route('profile.show') }}" class="text-white font-semibold hover:underline">{{ auth()->user()->name }}</a>
                    <a href="{{ route('logout') }}" class="hover:underline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="hover:underline">Register</a>
                @endauth
            </div>
        </nav>

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar fixed inset-y-0 left-0 w-64 bg-black text-white transform -translate-x-full p-4 z-50">
            <button id="sidebar-close" class="focus:outline-none text-white mb-4">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <ul>
                <li><a href="{{ route('dashboard') }}" class="block py-2 hover:underline">Home</a></li>
                <li><a href="#" class="block py-2 hover:underline">Menu Item 1</a></li>
                <li><a href="#" class="block py-2 hover:underline">Menu Item 2</a></li>
                <li><a href="#" class="block py-2 hover:underline">Menu Item 3</a></li>
            </ul>
        </div>

        <!-- Overlay -->
        <div id="overlay" class="hidden fixed inset-0 bg-black opacity-50 z-40"></div>

        <!-- Main Content -->
        <div id="main-content" class="mt-4 transition-all duration-300">
            @yield('content')
        </div>
    </div>

    <!-- JavaScript to handle the sidebar and content shift -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('main-content');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.add('sidebar-open');
            overlay.classList.remove('hidden');
            mainContent.classList.add('ml-64'); // Add left margin to main content when sidebar is open
        });

        document.getElementById('sidebar-close').addEventListener('click', function() {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.add('hidden');
            mainContent.classList.remove('ml-64'); // Remove left margin when sidebar is closed
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.add('hidden');
            mainContent.classList.remove('ml-64'); // Remove left margin when sidebar is closed
        });
    </script>
</body>
</html>

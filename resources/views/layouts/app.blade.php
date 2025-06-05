<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DevStragam - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>

<body class="flex flex-col min-h-dvh">
    <!-- Loader Global -->
    <div id="page-loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white bg-opacity-80 hidden">
        <div class="text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mx-auto"></div>
            <p class="mt-4 text-gray-600">Loading...</p>
        </div>
    </div>
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center gap-4">
            <a href="{{ route('home') }}" class="text-3xl font-black">
                DevStragam
            </a>

            <!-- Menú desktop -->
            <nav class="hidden sm:flex gap-2 items-center">
                @auth
                <a href="{{ route('posts.create') }}"
                    class="flex items-center gap-2 border bg-sky-600 hover:bg-sky-700 text-white p-2 rounded uppercase text-xs font-bold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Post
                </a>

                <a href="{{ route('posts.index', auth()->user()->username) }}"
                    class="font-bold uppercase text-gray-600 text-sm flex gap-1 items-center">
                    <x-avatar
                        url="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : null }}"
                        class="size-8" alt="Avatar of {{ auth()->user()->username }}" />
                    <span class="font-normal">{{ auth()->user()->username }}</span>
                </a>

                <form action="{{ route('logout') }}" method="post" class="flex items-center">
                    @csrf
                    <input type="submit" value="Logout"
                        class="font-bold uppercase text-gray-600 text-sm cursor-pointer hover:text-gray-700 transition-colors">
                </form>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                <a href="{{ route('register.index') }}" class="font-bold uppercase text-gray-600 text-sm">Create
                    Account</a>
                @endguest
            </nav>

            <!-- Botón de menú móvil -->
            <button id="mobile-menu-button" class="sm:hidden p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <!-- Menú móvil -->
        <div id="mobile-menu"
            class="sm:hidden hidden flex-col gap-3 mt-4 px-4 py-3 bg-white shadow-md rounded-lg transition-all duration-300 ease-in-out">
            @auth
            <a href="{{ route('posts.create') }}"
                class="flex items-center gap-2 text-gray-700 hover:text-sky-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Post
            </a>

            <a href="{{ route('posts.index', auth()->user()->username) }}"
                class="flex items-center gap-2 text-gray-700 hover:text-sky-600 transition-colors">
                <x-avatar url="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : null }}"
                    class="size-8" alt="Avatar of {{ auth()->user()->username }}" />
                <span>{{ auth()->user()->username }}</span>
            </a>

            <form action="{{ route('logout') }}" method="POST" class="flex">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 text-red-600 hover:text-red-800 transition-colors w-full text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25v-4.5M12 9l3 3m0 0l-3 3m3-3H9" />
                    </svg>
                    Logout
                </button>
            </form>
            @endauth

            @guest
            <a href="{{ route('login') }}"
                class="flex items-center gap-2 text-gray-700 hover:text-sky-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25v-4.5M12 9l3 3m0 0l-3 3m3-3H9" />
                </svg>
                Login
            </a>
            <a href="{{ route('register.index') }}"
                class="flex items-center gap-2 text-gray-700 hover:text-sky-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 14v4.75A2.25 2.25 0 0116.75 21H7.25A2.25 2.25 0 015 18.75V14M5 14L3 9m2 5V6a1 1 0 011-1h1.172a2.25 2.25 0 011.59.659l1.591 1.591c.382.382.905.572 1.43.572H14.25a2.25 2.25 0 011.59-.659l1.591-1.591a1 1 0 00.296-.707V6a1 1 0 011-1h2.25a2.25 2.25 0 012.25 2.25v10.5A2.25 2.25 0 0119 19.5z" />
                </svg>
                Create Account
            </a>
            @endguest
        </div>
    </header>
    <main class=" container mx-auto mt-10 flex-1 max-sm:px-2">
        <h2 class=" font-black text-center text-3xl mb-10">@yield("title")</h2>
        @yield('content')
    </main>
    <footer class=" text-center p-5 text-gray-500 font-bold uppercase">
        DevStragam - All rights reserved {{ now()->year }}
    </footer>



    <script type="module">
        const error = '{{ session('error') }}';
        const success = '{{ session('success') }}';

        if (success) {
            showAlert("success", "Success!", success);
        }

        if (error) {
            showAlert("error", "Error!", error);
        }
    </script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
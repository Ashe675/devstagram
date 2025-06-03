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

    <header class=" p-5 border-b bg-white shadow">
        <div class=" container mx-auto flex justify-between items-center gap-4">
            <a href="{{route('home')}}" class=" text-3xl font-black">
                DevStragam
            </a>
            <nav class=" flex gap-2 items-center">
                @auth
                    <a href="{{ route('posts.create') }}"
                        class=" flex items-center gap-2 border bg-sky-600 hover:bg-sky-700 text-white p-2 rounded uppercase text-xs font-bold transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                        New Post
                    </a>

                    <a href="{{route('posts.index', auth()->user()->username)}}"
                        class=" font-bold uppercase text-gray-600 text-sm text-center flex gap-1 items-center">
                        <x-avatar
                            url="{{ auth()->user()->avatar ? asset('uploads/avatars/' . auth()->user()->avatar) : null }}"
                            class="size-8" alt="Avatar of {{ auth()->user()->username }}" />
                        <span class=" font-normal">
                            {{ auth()->user()->username }} </span>
                    </a>
                    <form action="{{route('logout')}}" method="post" class=" flex items-center">
                        @csrf
                        <input type="submit" value="Logout"
                            class=" font-bold uppercase text-gray-600 text-sm text-center cursor-pointer hover:text-gray-700 transition-colors ">
                    </form>
                @endauth

                @guest
                    <a href="{{route('login')}}" class=" font-bold uppercase text-gray-600 text-sm text-center">Login</a>
                    <a href="{{route('register.index')}}"" class=" font-bold uppercase text-gray-600 text-sm
                        text-center">Create
                        Account</a>
                @endguest
            </nav>
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
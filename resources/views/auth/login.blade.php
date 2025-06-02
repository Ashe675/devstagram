@extends('layouts.app')

@section('title', 'Sign In for DevStragam')


@section('content')
    <div class=" md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 md:p-5 max-sm:mb-5 ">
            <img src="{{ asset('img/login.jpg')}}" alt="login image" class=" shadow-xl" />
        </div>
        <div class="md:w-5/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login')}}" method="post" novalidate>
                @csrf
                @if (session('error'))
                    <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('error') }}
                    </p>

                @endif
                <div class="mb-5">
                    <label for="email" class=" mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your register email"
                        class=" border p-2 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" />
                    @error('email')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class=" mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Your register password"
                        class=" border p-2 w-full rounded-lg @error('password') border-red-500 @enderror"
                        value="{{ old('password') }}" />
                    @error('password')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="remember" class=" inline-flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <span class="text-gray-500  text-sm">Remember me</span>
                    </label>
                </div>

                <input type="submit" value="Login"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg" />

            </form>
        </div>
    </div>

@endsection
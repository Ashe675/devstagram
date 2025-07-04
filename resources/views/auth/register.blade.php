@extends('layouts.app')

@section('title', 'Sign Up for DevStragam')


@section('content')
    <div class=" md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 md:p-5 max-sm:mb-5 ">
            <img src="{{ asset('img/registrar.jpg')}}" alt="register image" class=" shadow-xl" />
        </div>
        <div class="md:w-5/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route('register.store')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class=" mb-2 block uppercase text-gray-500 font-bold">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name"
                        class=" border p-2 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}" />
                    @error('name')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class=" mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Your username"
                        class=" border p-2 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ old('username') }}" />
                    @error('username')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
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
                    <label for="password_confirmation" class=" mb-2 block uppercase text-gray-500 font-bold">Confirm
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm your password"
                        class=" border p-2 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror"
                        value="{{ old('password_confirmation') }}" />
                    @error('password_confirmation')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="Create Account"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg" />

            </form>
        </div>
    </div>

@endsection
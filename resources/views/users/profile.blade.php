@extends('layouts.app')


@section('title', 'Profile of ' . $user->username)

@section('content')

    <div class=" flex justify-center">
        <div class=" w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class=" w-8/12 lg:w-6/12 px-5">
                <x-avatar url="{{ $user->avatar ? asset('storage/avatars/' . $user->avatar) : null }}"
                    alt="Image of user {{ $user->username }}" />
            </div>
            <div class=" flex flex-col md:justify-center py-10 md:items-start md:w-8/12 lg:w-6/12 px-5">
                <div class=" flex items-center gap-2">
                    <p class=" text-gray-700 text-2xl ">
                        {{ $user->username }}
                    </p>
                    @auth
                        @if (auth()->user()->id === $user->id)
                            <a href="{{ route('profile.edit') }}" class=" text-gray-500 hover:text-gray-700 transition-colors ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 ">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>


                            </a>

                        @endif
                    @endauth
                </div>
                <p class=" text-gray-800 text-sm mt-5 mb-3 font-bold">
                    {{$user->followers()->count()}} <span class=" font-normal">
                        @choice('Follower|Followers', $user->followers()->count())</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    {{$user->following()->count()}} <span class=" font-normal"> Following</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts()->count() }} <span class=" font-normal"> @choice('Post|Posts', $user->posts()->count())</span>
                </p>
                @auth
                    @if (auth()->user()->id !== $user->id)
                        @if (auth()->user()->isFollowing($user))
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Unfollow"
                                    class=" bg-red-600 text-white uppercase font-semibold rounded-lg px-4 text-sm py-1 cursor-pointer transition-colors hover:bg-red-700 mt-2">
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input type="submit" value="Follow"
                                    class=" bg-blue-600 text-white uppercase font-semibold rounded-lg px-4 text-sm py-1 cursor-pointer transition-colors hover:bg-blue-700 mt-2">
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class=" container mx-auto px-5 mt-10">
        <h2 class=" text-4xl text-center font-black my-10">
            Posts
        </h2>
        @if($posts->count())
            <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ["user" => $user, "post" => $post]) }}">
                            <img src="{{ asset('/storage/posts/' . $post->image) }}" alt="Image of post {{ $post->title }}"
                                class=" ">
                        </a>
                    </div>

                @endforeach
            </div>
        @else
            <p class=" text-gray-600 text-center  w-full text-sm">
                This user has no posts yet.
            </p>
        @endif

        <div class=" my-10 w-full">
            {{-- Pagination --}}
            {{ $posts->links() }}
        </div>
    </section>
@endsection
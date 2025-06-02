@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class=" container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads/posts' . '/' . $post->image)}}" alt=" Image of post {{ $post->title }}" class="">
            <div class="py-3 flex items-center gap-2">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>
            <div>
                <p class=" font-bold">{{$post->user->username}}</p>
                <p class=" text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{route('posts.destroy', $post)}}" method="POST" class="mt-5 delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class=" delete-button bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg">
                            Delete Post
                        </button>
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 md:pl-5 pt-5 md:pt-0">
            <div class=" bg-white shadow p-5 mb-5">

                @auth
                    <p class=" text-xl font-bold text-center mb-4">
                        Add a Comment
                    </p>
                    <form action="{{route('comments.store', ['user' => $user, 'post' => $post])}}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comment" class=" mb-2 block uppercase text-gray-500 font-bold">comment</label>
                            <textarea rows="3" type="text" id="comment" name="comment" placeholder="Add a comment"
                                class=" resize-none border p-2 w-full rounded-lg @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message ?? 'The comment field is required.' }}
                                </p>
                            @enderror
                        </div>
                        <input type="submit" value="Comment"
                            class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg" />
                    </form>
                @endauth

                @guest
                    <p class=" text-center text-gray-500 font-bold">
                        You must be logged in to add a comment
                    </p>
                    <a href="{{route('login')}}"
                        class=" block text-center bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg">Login</a>
                @endguest

                <div>
                    <p class=" text-xl font-bold text-center mt-4 mb-1">
                        Comments
                    </p>

                    <div class=" overflow-hidden max-h-96 overflow-y-scroll rounded-lg p-3  ">

                        @if ($post->comments->count())
                            @foreach ($post->comments as $comment)
                                <div class="  mb-3  flex gap-2">

                                    <div>
                                        <a class=" shadow-sm rounded-full inline-block "
                                            href="{{route('posts.index', $comment->user->username)}}">
                                            <x-avatar class=" shadow-md"
                                                url="{{ $comment->user->avatar ? asset('uploads/avatars/' . $comment->user->avatar) : null}}"
                                                class="size-10" alt="Avatar of {{ $comment->user->username }}" />
                                        </a>
                                    </div>
                                    <div class=" flex-1 border bg-gray-50 rounded-lg py-1 px-2  shadow-sm">
                                        <a href="{{route('posts.index', $comment->user->username)}}" class=" font-bold">

                                            {{$comment->user->username}}
                                        </a>
                                        <p class="">
                                            {{$comment->comment}}
                                        </p>
                                        <p class="text-xs text-gray-500 float-right mt-1">
                                            {{$comment->created_at->diffForHumans()}}
                                        </p>
                                    </div>

                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-center">No comments yet</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
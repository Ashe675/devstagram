<div class=" flex flex-col gap-2">
    <div class=" items-center flex gap-2">
        <a href="{{ route('posts.index', $post->user->username) }}" class=" hover:text-gray-600 transition-colors">
            <x-avatar class=" shadow-md"
                url="{{ $post->user->avatar ? asset('uploads/avatars/' . $post->user->avatar) : null }}" class="size-10"
                alt="Avatar of {{ $post->user->username }}" />
        </a>

        <div>
            <p class=" text-gray-700 font-bold">
                <a href="{{ route('posts.index', $post->user->username) }}"
                    class=" hover:text-gray-600 transition-colors">
                    {{ $post->user->username }}
                </a>
            </p>
            <p class=" text-gray-500 text-sm">
                {{ $post->created_at->diffForHumans() }}
            </p>
        </div>
    </div>
    <a href="{{ route('posts.show', ["user" => $post->user, "post" => $post]) }}">
        <img src="{{ asset('/uploads/posts/' . $post->image) }}" alt="Image of post {{ $post->title }}" class=" ">
    </a>
    <livewire:like-post :post="$post" />
    <div>
        <p class=" font-semibold">{{ $post->title}}</p>
        <p class=" text-xs text-gray-600">{{$post->description}}</p>
    </div>

</div>
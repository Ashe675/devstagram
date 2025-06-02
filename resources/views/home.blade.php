@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @if (count($posts))
        <div class=" container mx-auto max-w-xl space-y-7">
            @foreach ($posts as $post)
               <x-post-item :post="$post" />
            @endforeach
        </div>
        <div class=" my-10 w-full">
            {{-- Pagination --}}
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-600 text-center w-full text-sm">
            No posts available yet. Follow users to see their posts.
        </p>

    @endif

@endsection
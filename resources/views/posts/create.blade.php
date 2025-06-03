@extends('layouts.app')

@section('title', 'Create a New Post')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class=" md:flex md:items-center">
        <div class=" md:w-1/2 px-10">
            <form action="{{ route('images.store') }}" id="dropzone" method="post" enctype="multipart/form-data"
                class=" dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center ">
                @csrf
            </form>
        </div>
        <div class=" md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{route('posts.store')}}" method="POST" novalidate>
                @include('posts._form')
                <input type="submit" value="Create Post"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        initDropzone();
    </script>
@endpush
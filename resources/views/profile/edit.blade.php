@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        .dropzone .dz-preview .dz-image {
            border-radius: 100%;
            width: 100%;
            height: 100%;
            overflow: visible;
        }

        .dropzone .dz-preview .dz-image img {
            border-radius: 100%;
            object-fit: contain;
        }
    </style>
@endpush


@section('title', 'Edit Profile: ' . auth()->user()->username)


@section('content')

    <div class=" container max-w-4xl mx-auto md:flex md:justify-center md:items-center bg-white p-5 rounded-lg shadow-lg">
        <div class=" md:w-1/2 m-5">
            <div id="current-image-section" class=" mt-5 relative">
                <x-avatar url="{{ auth()->user()->avatar ? asset('uploads/avatars/' . auth()->user()->avatar) : null }}"
                    alt="Avatar of {{ auth()->user()->username }}" />
                <button id="btn-edit-image"
                    class=" bg-white shadow hover:bg-gray-50 p-2 rounded-full text-gray-500 hover:text-gray-700 transition-colors absolute right-1/4 bottom-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path
                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path
                            d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
                </button>
            </div>

            <div id="edit-image-section" class=" hidden mt-5">
                <form action="{{ route('images.avatar.store', ["user" => auth()->user()]) }}" id="dropzone" method="post"
                    enctype="multipart/form-data"
                    class=" dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                    @csrf
                </form>
                <button id="btn-cancel-edit-image"
                    class=" bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg mt-5">
                    Cancel
                </button>
            </div>
        </div>
        <div class=" md:w-1/2 p-5 ">

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class=" mt-10 md:mt-0">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="username" class=" mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Your username"
                        class=" border p-2 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ old('username', auth()->user()->username) }}" />
                    @error('username')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="hidden" name="image" id="image" value="{{ old('image') }}" />
                    @error('image')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="Save Changes"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg" />
            </form>
        </div>

    </div>
@endsection


@push('scripts')
    <script type="module">
        import { initDropzone } from '{{ Vite::asset('resources/js/components/dropzone.js') }}';
        const dropzone = initDropzone('/uploads/avatars');

        const btnEditImage = document.querySelector('#btn-edit-image');
        const editImageSection = document.querySelector('#edit-image-section');
        const currentImageSection = document.querySelector('#current-image-section');

        const btnCancelEditImage = document.querySelector('#btn-cancel-edit-image');

        btnCancelEditImage.addEventListener('click', () => {
            editImageSection.classList.add('hidden');
            currentImageSection.classList.remove('hidden');
            dropzone.removeAllFiles(true);

            document.querySelector('#image').value = '';

        })

        btnEditImage.addEventListener('click', () => {
            editImageSection.classList.remove('hidden');
            currentImageSection.classList.add('hidden');

        })

    </script>
@endpush
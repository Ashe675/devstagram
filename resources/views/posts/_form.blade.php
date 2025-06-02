@csrf
<div class="mb-5">
    <label for="title" class=" mb-2 block uppercase text-gray-500 font-bold">Title</label>
    <input type="text" id="title" name="title" placeholder="Post title"
        class=" border p-2 w-full rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}" />
    @error('title')
        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="mb-5">
    <label for="description" class=" mb-2 block uppercase text-gray-500 font-bold">Description</label>
    <textarea rows="3" type="text" id="description" name="description" placeholder="Post description"
        class=" resize-none border p-2 w-full rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
    @error('description')
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
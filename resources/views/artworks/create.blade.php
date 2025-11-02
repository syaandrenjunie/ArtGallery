<x-layout>

    <x-slot:heading>
        Create Artwork
    </x-slot:heading>

    <x-slot:resource>artworks</x-slot:resource>
    
    <form action="{{ route('artworks.store') }}" method="POST" enctype="multipart/form-data">
    @csrf        
    <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Profile</h2>
                <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful what
                    you share.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium text-gray-900">Cover photo</label>

                        <div
                            class="mt-2 flex flex-col items-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center" id="preview-container">
                                <svg id="preview-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                    class="mx-auto size-12 text-gray-300">
                                    <path
                                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                        clip-rule="evenodd" fill-rule="evenodd" />
                                </svg>
                                <img id="preview-image" class="hidden mx-auto rounded-md max-h-48" />
                                <div class="mt-4 flex text-sm text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer rounded-md font-semibold text-indigo-600 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="picture" type="file" class="sr-only"
                                            accept=".jpg,.jpeg,.png,.gif,.pdf" />

                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-600">PDF, PNG, JPG, JPEG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="artist_id" class="block text-sm/6 font-medium text-gray-900">Artist Name</label>
                        <div class="mt-2">
                            <select id="artist_id" name="artist_id"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                                    ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                <option value="">Select an artist</option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}"> {{ $artist->name }}</option>
                                    <!--<option __send the id to db__ value = "id">  __then to display the artist name__{{ $artist->name}} -->
                                @endforeach
                            </select>

                            @error('artist_id')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="category_id" class="block text-sm/6 font-medium text-gray-900">Category</label>
                        <div class="mt-2">
                            <select id="category_id" name="category_id"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                                    ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input id="title" type="textarea" name="title"
                                    placeholder="2 Baddies 2 Baddies 1 Porsche"
                                    class="py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    required />
                            </div>

                            @error('title')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="price" class="block text-sm/6 font-medium text-gray-900">Price</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input id="price" type="textarea" name="price" placeholder="RM 1000"
                                    class="py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    required />
                            </div>

                            @error('price')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>




                </div>
            </div>





            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
    </form>

    <script>
        document.getElementById('file-upload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const previewIcon = document.getElementById('preview-icon');

            if (file) {
                // Only preview images, not PDFs
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        previewIcon.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Hide image preview for non-image (e.g. PDF)
                    previewImage.classList.add('hidden');
                    previewIcon.classList.remove('hidden');
                }
            }
        });
    </script>



</x-layout>
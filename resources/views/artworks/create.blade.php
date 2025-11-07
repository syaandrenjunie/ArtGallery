<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Artwork') }}
        </h2>
    </x-slot>

    <x-slot:resource>artworks</x-slot:resource>
    <x-card-container>


        <form action="{{ route('artworks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        
                        {{-- Picture --}}
                        <div class="col-span-full">
                            <x-input-label for="cover-photo" class="block text-sm font-medium text-gray-900">Cover
                                photo</x-input-label>

                            <div
                                class="mt-2 flex flex-col items-center rounded-lg border border-dashed border-gray-900/25 px-4 py-4">
                                <div class="text-center" id="preview-container">
                                    <svg id="preview-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                        class="mx-auto size-12 text-gray-300">
                                        <path
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                    <img id="preview-image" class="hidden mx-auto rounded-md max-h-48" />
                                    <div class="mt-4 flex text-sm text-gray-600">
                                        <x-input-label for="file-upload"
                                            class="relative cursor-pointer rounded-md font-semibold text-indigo-600 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="picture" type="file" class="sr-only"
                                                accept=".jpg,.jpeg,.png,.gif,.pdf" />

                                        </x-input-label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-600">PDF, PNG, JPG, JPEG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Artist --}}
                        <div class="sm:col-span-4" x-data="{ selectedArtistName: 'Select an artist' }">
                            <x-input-label class="block text-sm font-medium text-gray-900 mb-1">Artist
                                Name</x-input-label>

                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="inline-flex justify-between w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-50">
                                        <span x-text="selectedArtistName"></span>
                                        <svg class="size-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @foreach ($artists as $artist)
                                        <x-dropdown-link href="#" @click.prevent="
                                                        $refs.artistInput.value = {{ $artist->id }};
                                                        selectedArtistName = '{{ $artist->name }}';
                                                     ">
                                            {{ $artist->name }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>

                            <!-- Hidden input to save the selected dropdown input-->
                            <input type="hidden" name="artist_id" x-ref="artistInput" required>

                            @error('artist_id')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="sm:col-span-4" x-data="{ selectedCategoryName: 'Select a category' }">
                            <x-input-label class="block text-sm font-medium text-gray-900 mb-1">Category</x-input-label>

                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="inline-flex justify-between w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-50">
                                        <span x-text="selectedCategoryName"></span>
                                        <svg class="size-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @foreach ($categories as $category)
                                        <x-dropdown-link href="#" @click.prevent="
                                                        $refs.categoryInput.value = {{ $category->id }};
                                                        selectedCategoryName = '{{ $category->name }}';
                                                     ">
                                            {{ $category->name }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>

                            <!-- Hidden input to save the selected dropdown input-->
                            <input type="hidden" name="category_id" x-ref="categoryInput" required>

                            @error('category_id')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div class="col-span-full">
                            <x-input-label for="title" class="block text-sm font-medium text-gray-900">
                                Title
                            </x-input-label>

                            <x-text-input id="title" name="title" type="text" placeholder="Greece Land"
                                class="mt-1 block w-full" required />

                            @error('title')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="col-span-full">
                            <x-input-label for="price" class="block text-sm font-medium text-gray-900">
                                Price
                            </x-input-label>

                            <x-text-input id="price" name="price" type="text" placeholder="1299.99"
                                class="mt-1 block w-full" required />

                            @error('price')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>
                </div>


                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                    <x-primary-button type="submit">Save</x-primary-button>
                </div>
        </form>
    </x-card-container>

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




</x-app-layout>
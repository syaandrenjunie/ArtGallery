<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $artwork->title }} Details
        </h2>
    </x-slot>

    <x-slot:resource>artworks</x-slot:resource>

    <x-card-container>

        <form method="POST" action="{{ route('artworks.update', $artwork) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">


                    <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        {{-- Picture --}}
                        <div class="col-span-full">
                            <x-input-label for="cover-photo" class="block text-sm font-medium text-gray-900">Cover
                                photo</x-input-label>

                            <div
                                class="mt-2 flex flex-col items-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center" id="preview-container">

                                    <!-- Default icon (hidden when image exists or new image selected) -->
                                    <svg id="preview-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                        class="mx-auto size-12 text-gray-300 {{ $artwork->picture ? 'hidden' : '' }}">
                                        <path
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>

                                    <!-- Show old image if available -->
                                    <img id="preview-image"
                                        src="{{ $artwork->picture ? (Str::startsWith($artwork->picture, 'http') ? $artwork->picture : asset('storage/' . $artwork->picture)) : '' }}"
                                        class="{{ $artwork->picture ? '' : 'hidden' }} mx-auto rounded-md max-h-48"
                                        alt="Artwork preview" />

                                    <div class="mt-4 flex text-sm text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer rounded-md font-semibold text-indigo-600 hover:text-indigo-500">
                                            <span>Change picture</span>
                                            <input id="file-upload" name="picture" type="file" class="sr-only"
                                                accept=".jpg,.jpeg,.png,.gif,.pdf" />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-600">PDF, PNG, JPG, JPEG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Artist --}}
                        <div class="sm:col-span-4" x-data="{
                            selectedArtistName: '{{ old('artist_id', $artwork->artist_id) ? $artwork->artist->name : 'Select an artist' }}'
                        }">

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
                                                        $refs.artistInput.value = '{{ $artist->id }}';
                                                        selectedArtistName = '{{ $artist->name }}';
                                                    ">
                                            {{ $artist->name }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>

                            <!-- Hidden input with default selected artist id -->
                            <input type="hidden" name="artist_id" x-ref="artistInput"
                                value="{{ old('artist_id', $artwork->artist_id) }}" required>

                            @error('artist_id')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="sm:col-span-4" x-data="{
                            selectedCategoryName: '{{ old('category_id', $artwork->category_id) ? $artwork->category->name : 'Select an category' }}'
                        }">

                            <x-input-label class="block text-sm font-medium text-gray-900 mb-1">Category
                                Name</x-input-label>

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
                                                        $refs.categoryInput.value = '{{ $category->id }}';
                                                        selectedCategoryName = '{{ $category->name }}';
                                                    ">
                                            {{ $category->name }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>

                            <!-- Hidden input with default selected category id -->
                            <input type="hidden" name="category_id" x-ref="categoryInput"
                                value="{{ old('category_id', $artwork->category_id) }}" required>

                            @error('category_id')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div class="sm:col-span-4">
                            <x-input-label for="title" class="block text-sm font-medium text-gray-900">
                                Title
                            </x-input-label>

                            <x-text-input id="title" name="title" type="text"
                                placeholder="2 Baddies 2 Baddies 1 Porsche" class="mt-1 block w-full"
                                value="{{ $artwork->title }}" required />

                            @error('title')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror


                        </div>

                        {{-- Price --}}
                        <div class="sm:col-span-4">
                            <x-input-label for="price" class="block text-sm font-medium text-gray-900">
                                Price
                            </x-input-label>

                            <x-text-input id="price" name="price" type="text" placeholder="RM 1000"
                                class="mt-1 block w-full" value="{{ $artwork->price }}" required />

                            @error('price')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>


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
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        previewIcon.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    // hide preview for non-image files
                    previewImage.classList.add('hidden');
                    previewIcon.classList.remove('hidden');
                }
            }
        });
    </script>



</x-app-layout>
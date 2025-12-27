<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $artist->name}} Details
        </h2>

    </x-slot>

    <x-card-container>


        <form id="artist-edit-form" class="space-y-6">
            @csrf

            <div class="space-y-8">

                <div id="vue-app"></div>


                {{-- Name --}}
                <div>
                    <x-input-label for="name" class="block text-sm font-medium text-gray-900">Name</x-input-label>
                    <x-text-input id="name" name="name" type="text" placeholder="Jane Smith" class="mt-1 block w-full"
                        :value="old('name', $artist->name)" required />
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bio --}}
                <div>
                    <x-input-label for="bio" class="block text-sm font-medium text-gray-900">Bio</x-input-label>
                    <x-text-area id="bio" name="bio" rows="3" class="mt-1 block w-full"
                        placeholder="Write a few sentences about yourself.">{{ old('bio', $artist->bio) }}</x-text-area>

                    @error('bio')
                        <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" class="block text-sm font-medium text-gray-900">Email
                        address</x-input-label>
                    <x-text-input id="email" name="email" type="email" placeholder="example@example.com"
                        :value="old('email', $artist->email)" class="mt-1 block w-full" required />
                    @error('email')
                        <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <x-input-label for="contact" class="block text-sm font-medium text-gray-900">Phone
                        number</x-input-label>
                    <x-text-input id="contact" name="contact" type="text" placeholder="0123456789"
                        :value="old('contact', $artist->contact)" class="mt-1 block w-full" required />
                    @error('contact')
                        <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- {{-- Picture --}}
                <div>
                    <x-input-label for="picture" class="block text-sm font-medium text-gray-900">Photo</x-input-label>
                    <input type="file" id="picture" name="picture" class="mt-1 block w-full text-sm text-gray-700" />
                    @error('picture')
                        <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div> -->

            </div>

            {{-- Buttons --}}
            <div class="mt-8 flex items-center justify-between">

                {{-- Left Side: Delete --}}
                <button form="delete-form" class="text-red-500 text-sm font-bold"
                    onclick="return confirm('Are you sure you want to delete this artist?')">
                    Delete
                </button>

                {{-- Right Side: Cancel + Save --}}
                <div class="flex items-center gap-x-4">
                    <a href="{{ route('artists.show', $artist) }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Cancel
                    </a>
                    <x-primary-button>
                        Save
                    </x-primary-button>
                </div>

            </div>


        </form>

        <!--if in forms we have another form then create the second form after first form and call the id at the selected button-->
        <!--delete form-->
        <form method="POST" action="{{ route('artists.destroy', $artist) }}" id="delete-form" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        {{-- API Submit Script --}}
        <script>
            document.getElementById('artist-edit-form').addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData(e.target);

                try {
                    formData.append('_method', 'PUT');

                    await window.api.post(
                        '/artists/{{ $artist->id }}',
                        formData
                    );

                    alert('Artist updated successfully!');
                    window.location.href = '/artists/{{ $artist->id }}';

                } catch (error) {
                    console.error(error);
                    alert('Failed to update artist');
                }
            });
        </script>


    </x-card-container>
</x-app-layout>
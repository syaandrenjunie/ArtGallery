<x-app-layout>

  <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create Artist') }}
    </h2>

  </x-slot>

  <x-card-container>

    <form id="artist-form" enctype="multipart/form-data" class="space-y-6">
    @csrf

      {{-- Name --}}
      <div>
          <x-input-label for="name" class="mb-1">
              Artist Name
          </x-input-label>

          <x-text-input
              id="name"
              name="name"
              type="text"
              placeholder="e.g. Jane Smith"
              class="block w-full"
              required
          />

          <p class="text-xs text-red-500 font-semibold hidden" id="error-name"></p>
      </div>

      {{-- Bio --}}
      <div>
          <x-input-label for="bio" class="mb-1">
              Biography
          </x-input-label>

          <x-text-area
              id="bio"
              name="bio"
              rows="4"
              placeholder="Write a short biography about the artist..."
              class="block w-full"
          />

          <p class="text-xs text-red-500 font-semibold hidden" id="error-bio"></p>
      </div>

      {{-- Email --}}
      <div>
          <x-input-label for="email" class="mb-1">
              Email Address
          </x-input-label>

          <x-text-input
              id="email"
              name="email"
              type="email"
              placeholder="artist@example.com"
              class="block w-full"
              required
          />

          <p class="text-xs text-red-500 font-semibold hidden" id="error-email"></p>
      </div>

      {{-- Contact --}}
      <div>
          <x-input-label for="contact" class="mb-1">
              Contact Number
          </x-input-label>

          <x-text-input
              id="contact"
              name="contact"
              type="text"
              placeholder="012-3456789"
              class="block w-full"
              required
          />

          <p class="text-xs text-red-500 font-semibold hidden" id="error-contact"></p>
      </div>

      {{-- Picture --}}
      <div>
          <x-input-label for="picture" class="mb-1">
              Artist Photo
          </x-input-label>

          <input
              id="picture"
              type="file"
              name="picture"
              class="block w-full text-sm text-gray-700
                    file:mr-4 file:rounded-md file:border-0
                    file:bg-gray-100 file:px-4 file:py-2
                    file:text-sm file:font-semibold
                    hover:file:bg-gray-200"
          />

          <p class="text-xs text-red-500 font-semibold hidden" id="error-picture"></p>
      </div>

      {{-- Buttons --}}
      <div class="flex justify-end gap-4 pt-4">
          <a href="{{ route('artists.index') }}"
            class="text-sm text-gray-600 hover:text-gray-900">
              Cancel
          </a>

          <x-primary-button>
              Save Artist
          </x-primary-button>
      </div>
    </form>


    <script>
    document.getElementById('artist-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        try {
            await window.api.post('/artists', formData);

            alert('Artist created!');
            window.location.href = '/artists';
        } catch (error) {
            console.error(error);
            alert('Failed to create artist');
        }
    });
    </script>

  </x-card-container>
</x-app-layout>
<x-app-layout>

  <x-slot name="header">
    <div class="flex justify-between items-center w-full">

      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Artworks Listing') }}
      </h2>

      @role('admin')
      <a href="{{ route('artworks.create') }}">
        <x-primary-button>
          + Create Artwork
        </x-primary-button>
      </a>
      @endrole

    </div>
  </x-slot>

  <x-slot:resource>artworks</x-slot:resource>

  

  <div class="mx-auto max-w-7xl px-4 pt-2 pb-6 sm:px-6 lg:px-8">

    <div class="mt-4 flex items-center gap-4">

      <!-- Vue Search -->
      <div id="search-artworks" class="flex-1"></div>

      <!-- Filter Form -->
      <form method="GET" action="{{ route('artworks.index') }}" class="flex items-center gap-3">

        <div x-data="{ 
          selectedStatus: '{{ request('status') ?? '' }}',
          selectedStatusName: '{{ request('status') ? ucfirst(request('status')) : 'Available' }}'
        }">

          <x-dropdown align="left" width="48">
            <x-slot name="trigger">
              <button type="button"
                class="inline-flex justify-between w-40 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-50">

                <span x-text="selectedStatusName"></span>

                <svg class="size-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
                </svg>

              </button>
            </x-slot>

            <x-slot name="content">

              <x-dropdown-link href="#" @click.prevent="
                        selectedStatus = '';
                        selectedStatusName = 'All Status';
                        $refs.statusInput.value = '';
                    ">
                All Status
              </x-dropdown-link>

              <x-dropdown-link href="#" @click.prevent="
                        selectedStatus = 'available';
                        selectedStatusName = 'Available';
                        $refs.statusInput.value = 'available';
                    ">
                Available
              </x-dropdown-link>

              <x-dropdown-link href="#" @click.prevent="
                        selectedStatus = 'sold';
                        selectedStatusName = 'Sold';
                        $refs.statusInput.value = 'sold';
                    ">
                Sold
              </x-dropdown-link>

            </x-slot>
          </x-dropdown>

          <!-- hidden input -->
          <input type="hidden" name="status" x-ref="statusInput" :value="selectedStatus">

        </div>

        <x-secondary-button type="submit">Filter</x-secondary-button>

      </form>
    </div>


    <!-- Blade Grid (Initial Load) -->
    <div id="blade-artwork-grid">
      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-4">
        @foreach ($artworks as $artwork)
          <div class="group relative">

            <!-- Favorite Button (only for logged-in users) -->
            @auth
              <div class="absolute top-2 right-2 z-10 favorite-button-mount" data-artwork-id="{{ $artwork->id }}"
                data-is-favorited="{{ auth()->user()->hasFavorited($artwork->id) ? 'true' : 'false' }}"
                data-favorites-count="{{ $artwork->favoritesCount() }}" data-size="md">
              </div>
            @endauth

            <img
              src="{{ Str::startsWith($artwork->picture, 'http') ? $artwork->picture : asset('storage/' . $artwork->picture) }}"
              alt="{{ $artwork->title }}"
              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
            <div class="mt-4 flex justify-between">
              <div>
                <h3 class="text-sm text-gray-700">
                  <a href="{{ route('artworks.show', $artwork) }}">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{ $artwork->title }}
                  </a>
                </h3>
                <p class="mt-1 text-sm text-gray-500">{{ $artwork->artist->name ?? 'Unknown Artist' }}</p>
              </div>
              <p class="text-sm font-medium text-gray-900">RM {{ number_format($artwork->price, 2) }}</p>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8">
        {{ $artworks->links() }}
      </div>
    </div>

  </div>
</x-app-layout>
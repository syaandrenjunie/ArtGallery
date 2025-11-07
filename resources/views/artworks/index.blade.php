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

      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-4">
        @foreach ($artworks as $artwork)
          <div class="group relative">
            <img
              src="{{ Str::startsWith($artwork->picture, 'http') ? $artwork->picture : asset('storage/' . $artwork->picture) }}"
              alt="{{ $artwork->title }}"
              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80"
            />
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
</x-app-layout>

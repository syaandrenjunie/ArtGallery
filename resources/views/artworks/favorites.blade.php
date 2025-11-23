<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Favorites') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 pt-2 pb-6 sm:px-6 lg:px-8">
        
        @if($favorites->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No favorites yet</h3>
                <p class="mt-1 text-sm text-gray-500">Start favoriting artworks you love!</p>
                <div class="mt-6">
                    <a href="{{ route('artworks.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Browse Artworks
                    </a>
                </div>
            </div>
        @else
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-4">
                @foreach ($favorites as $artwork)
                  <div class="group relative">
                    
                    <!-- Favorite Button -->
                    <div class="absolute top-2 right-2 z-10 favorite-button-mount"
                         data-artwork-id="{{ $artwork->id }}"
                         data-is-favorited="true"
                         data-favorites-count="{{ $artwork->favoritesCount() }}">
                    </div>

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
                {{ $favorites->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
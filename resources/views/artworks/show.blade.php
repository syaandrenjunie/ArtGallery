<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $artwork->title }}
    </h2>
  </x-slot>

  <x-slot:resource>artworks</x-slot:resource>

  <div class="bg-white">
    <div class="pt-4 ">


      <!-- Dynamic artwork image -->
      <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8">
        <img
          src="{{ Str::startsWith($artwork->picture, 'http') ? $artwork->picture : asset('storage/' . $artwork->picture) }}"
          alt="{{ $artwork->title }}" class="aspect-square w-full rounded-lg object-cover lg:h-[500px]" />
      </div>


      <!-- Product info -->
      <div
        class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
          <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $artwork->title }}</h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:row-span-3 lg:mt-0">
          <h2 class="sr-only">Product information</h2>
          <p class="text-3xl tracking-tight text-gray-900">RM {{ $artwork->price }}</p>

          @role('user')
          @if($artwork->status === 'available')

            <p class="mt-6">
              <a href="{{ route('artworks.chat', $artwork->id) }}">
                <x-edit-button>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227
                        1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133
                        a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379
                        c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228
                        A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513
                        C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                  </svg>
                  Chat Artist
                </x-edit-button>
              </a>
            </p>

          @else
            <span class="text-red-500 text-xl font-semibold">Sold</span>
          @endif
          @endrole


          @role('admin|artist')
          @if($artwork->status === 'available')
            <span class="text-green-600 text-xl font-semibold">Available</span>
          @else
            <span class="text-red-500 text-xl font-semibold">Sold</span>
          @endif
          @endrole


          @can('update', $artwork)
            <p class="mt-6">
              <a href="{{ route('artworks.edit', $artwork->id) }}">
                <x-edit-button>
                  Edit Artwork
                </x-edit-button>
              </a>
            </p>

          @endcan
          @can('delete', $artwork)


            <form action="{{ route('artworks.destroy', $artwork) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this artwork?');">
              @csrf
              @method('DELETE')

              <x-danger-button class="mt-6">
                Delete artwork
              </x-danger-button>

            </form>
          @endcan


        </div>

        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pr-8 lg:pb-16">
          <!-- Description and details -->
          <div>
            <h3 class="sr-only">Description</h3>

            <div class="space-y-6">

              <p class="text-xl tracking-tight text-gray-900 sm:text-lg">Made by: {{ $artwork->artist->name }}</p>

              <p class="text-xl tracking-tight text-gray-900 sm:text-lg">Category: {{$artwork->category->name}}</p>

            </div>
          </div>


          <div class="mt-10">
            <h2 class="text-sm font-medium text-gray-900">Details</h2>

            <div class="mt-4 space-y-6">
              <p class="text-sm text-gray-600">The 6-Pack includes two black, two white, and two heather gray Basic
                Tees. Sign up for our subscription service and be the first to get new, exciting colors, like our
                upcoming &quot;Charcoal Gray&quot; limited release.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
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
          <p class = "mt-6">
            <x-edit-button>Add To Cart</x-edit-button>
          </p>

          <x-danger-button>Buy Now</x-danger-button>
          @endrole

          @role('admin')
          <p class="mt-6">
            <a href="{{ route('artworks.edit', $artwork->id) }}">
              <x-edit-button>
                Edit Artwork
              </x-edit-button>
            </a>
          </p>

          <form action="{{ route('artworks.destroy', $artwork) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this artwork?');">
            @csrf
            @method('DELETE')

            <x-danger-button class="mt-6">
              Delete artwork
            </x-danger-button>

          </form>
          @endrole


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
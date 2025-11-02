<x-layout>
  <x-slot:heading>
    {{ $artwork['title'] }}
  </x-slot:heading>
  <x-slot:resource>artworks</x-slot:resource>

  <div class="bg-white">
    <div class="pt-4">


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



         <a href="{{ route('artworks.edit', $artwork) }}"
            class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent 
                    bg-green-600 px-8 py-3 text-base font-medium text-white 
                    hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-hidden">
            Edit artwork
          </a>

          <form action="{{ route('artworks.destroy', $artwork) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this artwork?');">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent 
               bg-red-600 px-8 py-3 text-base font-medium text-white 
               hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-hidden">
        Delete artwork
    </button>
</form>


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

  

</x-layout>
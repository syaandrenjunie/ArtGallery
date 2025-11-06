<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $artist->name }}
        </h2>
    </x-slot>

    <x-card-container>
        <div class="mx-auto mt-2 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8 mb-6 ">
            <img src="{{ Str::startsWith($artist->picture, 'http') ? $artist->picture : asset('storage/' . $artist->picture) }}"
                alt="{{ $artist->name }}" class="size-32 flex-none rounded-full bg-gray-100" />
        </div>

        <h2 class="text-lg font-bold">{{ $artist->name }}</h2>

        <p>{{ $artist->bio }}</p>
        <p>{{ $artist->email }}</p>
        <p>{{ $artist->contact}}</p>


        @role('admin')
        <p class="mt-6">
            <a href="{{ route('artists.edit', $artist->id) }}">
                <x-primary-button>
                    Edit Artist
                </x-primary-button>
            </a>
        </p>
        @endrole

    </x-card-container>



</x-app-layout>
<x-layout>
    <x-slot:heading>
       Artist Details: {{ $artist['name'] }} 
    </x-slot:heading>
    

    <p>{{ $artist->picture }}</p>

    <h2 class="text-lg font-bold">{{ $artist->name }}</h2>

    <p>{{ $artist->bio }}</p>
    <p>{{ $artist->email }}</p>
    <p>{{ $artist->contact}}</p>


    <p class="mt-6">
        <x-button href="{{ route('artists.edit', $artist) }}">
            Edit Artist</x-button>
    </p>


</x-layout>


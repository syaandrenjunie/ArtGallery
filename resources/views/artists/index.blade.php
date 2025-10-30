<x-layout>
    <x-slot:heading>
        Artists
    </x-slot:heading>

    <x-slot:resource>artists</x-slot:resource>

    <x-stack-list>
        @foreach ($artists as $artist)
            <x-stack-item :image="$artist->picture" :title="$artist->name" :subtitle="$artist->email"
                :description="$artist->bio" :footer="$artist->contact" :link="route('artists.show', $artist->id)" />
        @endforeach
    </x-stack-list>

    <div class="mt-4">
        {{ $artists->links() }}
    </div>
    
</x-layout>
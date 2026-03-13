<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artists Listing') }}
        </h2>

        @role('admin')
        <a href="{{ route('artists.create') }}">
            <x-primary-button>
                + Create Artist
            </x-primary-button>
        </a>
        @endrole

    </div>
    </x-slot>

        <div class="mx-auto max-w-7xl px-4 pt-2 pb-6 sm:px-6 lg:px-8">

            <div id="search-artists">
                <artist-search></artist-search>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div id="blade-artist-list">
                    <x-stack-list>
                        @foreach ($artists as $artist)
                            <x-stack-item 
                                :image="$artist->picture" 
                                :title="$artist->name" 
                                :subtitle="$artist->email"
                                :description="$artist->bio" 
                                :footer="$artist->contact" 
                                :link="route('artists.show', $artist->id)" 
                            />
                        @endforeach
                    </x-stack-list>

                    <div class="mt-4">
                        {{ $artists->links() }}
                    </div>

                </div>           
            </div>
        </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artists Listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Vue Component (Search Bar + Filtered Results) -->
                <div id="vue-search"></div> 
                
                <!-- Blade List (Initial Load) - Add ID for targeting -->
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
    </div>
</x-app-layout>
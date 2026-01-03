<div>
    @if (empty($searchText))
        {{-- Show all categories when not searching --}}
        <h3 class="font-bold mb-2">All Categories ({{ count($categories) }})</h3>
        <x-stack-list>
            @foreach ($categories as $category)
                <x-stack-item 
                    :title="$category->name" 
                    :description="$category->description"
                    :link="route('categories.show', $category->id)" />
            @endforeach
        </x-stack-list>
    @else
        {{-- Show search results when searching --}}
        <h3 class="font-bold mb-2">Search Results ({{ count($results) }})</h3>
        @if(count($results) > 0)
            <x-stack-list>
                @foreach ($results as $result)
                    <x-stack-item 
                        :title="$result->name" 
                        :description="$result->description"
                        :link="route('categories.show', $result->id)" />
                @endforeach
            </x-stack-list>
        @else
            <p class="text-red-500">No results found for "{{ $searchText }}"</p>
        @endif
    @endif
</div>
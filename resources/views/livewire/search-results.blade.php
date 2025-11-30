<div>
    @if (empty($searchText))
        {{-- Show initial blade list --}}
        <x-stack-list>
            @foreach ($categories as $category)
                <x-stack-item :title="$category->name" :description="$category->description" :link="route('categories.show', $category->id)" />
            @endforeach
        </x-stack-list>
    @endif

    @if (!empty($searchText))
        {{-- Show search results only when searching --}}
        <div class="{{ $isDropdownPage ? 'absolute mt-1 w-64 bg-white border rounded shadow-lg z-50' : '' }}">
            <x-stack-list>
            @foreach ($results as $result)
                @if($isDropdownPage)
                    <!-- Compact dropdown: show only title -->
                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        {{ $result->name }}
                    </div>
                @else
                    <!-- Normal list: show full stack-item -->
                    <x-stack-item 
                        :title="$result->name" 
                        :description="$result->description" 
                        :link="route('categories.show', $result->id)" />
                @endif
            @endforeach
        </x-stack-list>
        </div>
    @endif
</div>
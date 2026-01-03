<div>
    {{-- Simple input without custom component --}}
    <form>
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="searchText"
            placeholder="{{ $placeholder }}"
            class="w-9/12 px-4 py-2 border rounded"
        />
        
            <button 
                wire:click.prevent="clear"
                type="button"
                class="mt-2 px-4 py-2 bg-gray-700 text-white rounded"
                
                
            >
                Clear
            </button>
        
    </div>
    </form>
    
       
    {{-- Results --}}
    <div>
        @if (empty($searchText))
            <h3 class="font-bold mb-2">All Categories ({{ count($categories) }})</h3>
            <x-stack-list>
        @foreach ($categories as $category)
            <x-stack-item :title="$category->name" 
                :description="$category->description"
                :link="route('categories.show', $category->id)" />
        @endforeach
    </x-stack-list>
        @else
            <h3 class="font-bold mb-2">Search Results ({{ count($results) }})</h3>
            @if(count($results) > 0)
                <x-stack-list>
        @foreach ($results as $result)
            <x-stack-item :title="$result->name" 
                :description="$result->description"
                :link="route('categories.show', $result->id)" />
        @endforeach
    </x-stack-list>
            @else
                <p class="text-red-500">No results found for "{{ $searchText }}"</p>
            @endif
        @endif
    </div>
</div>
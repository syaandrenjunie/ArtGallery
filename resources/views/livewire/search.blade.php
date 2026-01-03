<div>
    {{-- Search Bar Form --}}
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
    
    {{-- Nested Child Component for Results --}}
    <livewire:search-results 
        :results="$results" 
        :searchText="$searchText"
        :categories="$categories" />
</div>
<div>

    <form>

        <div>

            <x-search-bar placeholder="{{ $placeholder }}" wire:model.live.debounce="searchText"
                wire:click.prevent="clear" :disabled="empty($searchText)" />

        </div>

    </form>
    
<livewire:search-results 
        :results="$results" 
        :searchText="$searchText"
        :categories="$categories" />
</div>
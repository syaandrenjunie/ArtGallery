<div>

    <form>

        <div>

            <x-search-bar placeholder="Search the categories" wire:model.live.debounce="searchText"
                wire:click.prevent="clear" :disabled="empty($searchText)" />

        </div>

    </form>
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
            <x-stack-list>
                @foreach ($results as $result)
                    <x-stack-item :title="$result->name" :description="$result->description" :link="route('categories.show', $result->id)" />
                @endforeach
            </x-stack-list>
        @endif


    </div>


</div>
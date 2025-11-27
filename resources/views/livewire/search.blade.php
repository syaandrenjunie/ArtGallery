<div>

    <form>

        <div>

            <x-search-bar 
                placeholder="Search the categories"
                wire:model.live.debounce="searchText"
                wire:click.prevent="clear"
                :disabled="empty($searchText)"

            />

        </div>

    </form>
    <div class="mt-5">
        @foreach ($results as $result)
            <div class="pt-2">
                {{$result->name}}
            </div>
        @endforeach

    </div>


</div>
<div>
    <!-- Search Input -->
    <input
        type="text"
        placeholder="{{ $placeholder ?? 'Search...' }}"
        class="flex-1 w-9/12 px-4 py-2 border border-gray-300 rounded-lg 
               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"

        {{-- Apply only wire:model* --}}
        @foreach ($attributes->whereStartsWith('wire:model') as $key => $value)
            {{ $key }}="{{ $value }}"
        @endforeach
    />

    <!-- Clear Button -->
    <button 
    type="button"
    class="px-4 py-2 bg-gray-400 text-gray-700 rounded-lg 
            disabled:bg-gray-300"
    
    @foreach ($attributes->whereStartsWith('wire:click') as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach

    @if($attributes->get('disabled'))
        disabled
    @endif
>
    Clear
</button>

</div>

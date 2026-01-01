<div class="flex items-center gap-2">
    <!-- Search Input -->
    <x-search-input placeholder="{{ $placeholder }}" {{ $attributes->only(['wire:model']) }} />

    <!-- Clear Button (conditionally) -->
    @if($showClear ?? true)
        <x-search-clear {{ $attributes->only(['wire:click', 'disabled']) }} />
    @endif
</div>

@props([
    'name' => 'status',
    'value' => '',
    'label' => '',
    'checked' => false
])

<label class="flex items-center gap-2 cursor-pointer">
    <input 
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'text-indigo-600 border-gray-300 focus:ring-indigo-500']) }}
    >

    <span class="text-sm text-gray-700">
        {{ $label }}
    </span>
</label>
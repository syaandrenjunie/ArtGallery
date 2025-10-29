@props(['active' => false]) 

<a {{ $attributes->merge(['class' => ($active ? 'bg-gray-900 text-white' : 'text-gray-00 hover:bg-gray-700 hover:text-white') . ' rounded-md px-3 py-2 text-sm font-medium' ]) }} 
    > {{ $slot }} 
</a>
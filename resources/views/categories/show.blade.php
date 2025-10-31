<x-layout>
    <x-slot:heading>
       Category Details: {{ $category['name'] }} 
    </x-slot:heading>
    

    <h2 class="text-lg font-bold">{{ $category->name }}</h2>

    <p>{{ $category->description }}</p>

    <p class="mt-6">
       <x-button href="{{ route('categories.edit', $category) }}">
            Edit Category</x-button>
    </p>


</x-layout>


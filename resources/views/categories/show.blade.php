<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ $category->name }}
      </h2>
   </x-slot>

   <x-card-container>
      <h2 class="text-lg font-bold">{{ $category->name }}</h2>

      <p>{{ $category->description }}</p>

      <p class="mt-6">
         <a href="{{ route('categories.edit', $category->id) }}">
            <x-primary-button>
               Edit Category
            </x-primary-button>
         </a>
      </p>

   </x-card-container>



</x-app-layout>
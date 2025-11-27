<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Listing') }}
        </h2>

        @role('admin')
        <a href="{{ route('categories.create') }}">
            <x-primary-button>
                + Create New Category
            </x-primary-button>
        </a>
        @endrole

    </div>

    </x-slot>

    <x-slot:resource>categories</x-slot:resource>

    <x-card-container>

    <livewire:search />

    <!-- <x-stack-list>
        @foreach ($categories as $category)
            <x-stack-item :title="$category->name" 
                :description="$category->description"
                :link="route('categories.show', $category->id)" />
        @endforeach
    </x-stack-list> -->

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
    </x-card-container>
</x-app-layout>
<x-layout>
    <x-slot:heading>
        Category
    </x-slot:heading>

    <x-slot:resource>categories</x-slot:resource>

    <x-stack-list>
        @foreach ($categories as $category)
            <x-stack-item :title="$category->name" 
                :description="$category->description"
                :link="route('categories.show', $category->id)" />
        @endforeach
    </x-stack-list>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
    
</x-layout>
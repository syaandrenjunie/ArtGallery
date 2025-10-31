<x-layout>

    <x-slot:heading>
        Edit Category: {{ $category->name }}
    </x-slot:heading>

    <x-slot:resource>categories</x-slot:resource>


    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input id="name" type="text" name="name" placeholder="janesmith"
                                    value="{{ $category->name }}"
                                    class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    required />
                            </div>

                            @error('name')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 
                                    placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Describe the category.">{{ old('description', $category->description) }}</textarea>
                        </div>

                        @error('description')
                            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center gap-x-6">

                <button form="delete-form" class="text-red-500 text-sm font-bold"
                    onclick="return confirm('Are you sure you want to delete this category?')">
                    Delete
                </button>


            </div>
            <div class="flex items-center gap-x-6">

                <a href="/categories/{{  $category->id }}/" type="button"
                    class="text-sm/6 font-semibold text-gray-900">Cancel</a>

                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Save</button>


            </div>


        </div>


    </form>
    <!--if in forms we have another form then create the second form after first form and call the id at the selected button-->
    <!--delete form-->
    <form method="POST" action="{{ route('categories.destroy', $category) }}" id="delete-form" class="hidden">
    @csrf
    @method('DELETE')
</form>



</x-layout>
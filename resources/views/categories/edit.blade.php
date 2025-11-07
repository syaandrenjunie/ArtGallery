<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>
    <x-slot:resource>categories</x-slot:resource>

    <x-card-container>

        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PATCH')

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 ">

                    <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <x-input-label for="name"
                                class="block text-sm/6 font-medium text-gray-900">Name</x-input-label>

                            <div class="mt-2">
                                <x-text-input id="name" type="text" name="name" value="{{ $category->name }}"
                                    placeholder="janesmith"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300
                                        placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                    required />
                            </div>

                            @error('name')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="col-span-full">
                            <x-input-label for="description"
                                class="block text-sm/6 font-medium text-gray-900">Description</x-input-label>
                            <div class="mt-2">
                                <x-text-area id="description" name="description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300
                                    placeholder:text-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm"
                                    placeholder="Describe the category.">{{ old('description', $category->description) }}</x-text-area>

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

                    <x-danger-button form="delete-form" class="text-red-500 text-sm font-bold"
                        onclick="return confirm('Are you sure you want to delete this category?')">
                        Delete
                    </x-danger-button>


                </div>
                <div class="flex items-center gap-x-6">

                    <a href="/categories/{{  $category->id }}/" type="button"
                        class="text-sm/6 font-semibold text-gray-900">Cancel</a>

                    <x-primary-button type="submit">Save</x-primary-button>


                </div>


            </div>


        </form>
        <!--if in forms we have another form then create the second form after first form and call the id at the selected button-->
        <!--delete form-->
        <form method="POST" action="{{ route('categories.destroy', $category) }}" id="delete-form" class="hidden">
            @csrf
            @method('DELETE')
        </form>

    </x-card-container>

</x-app-layout>
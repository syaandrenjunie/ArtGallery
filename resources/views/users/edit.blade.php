<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <x-card-container>
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- User Name --}}
                <div>
                    <x-input-label for="name" class="mb-1">User Name</x-input-label>
                    <x-text-input id="name" name="name" type="text" class="block w-full" value="{{ $user->name }}"
                        disabled />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" class="mb-1">Email Address</x-input-label>
                    <x-text-input id="email" name="email" type="email" class="block w-full" value="{{ $user->email }}"
                        disabled />
                </div>

                {{-- Contact --}}
                <div>
                    <x-input-label for="contact" class="mb-1">Contact Number</x-input-label>
                    <x-text-input id="contact" name="contact" type="text" class="block w-full"
                        value="{{ $user->contact }}" disabled />
                </div>


                {{-- Role --}}
                <div>
                    <x-input-label for="role" class="mb-1">Role</x-input-label>

                    <div class="flex gap-6 mt-2">

                        <x-status-radio name="role" value="user" label="User" :checked="old('role', $user->getRoleNames()->first()) == 'user'" />

                        <x-status-radio name="role" value="artist" label="Artist" :checked="old('role', $user->getRoleNames()->first()) == 'artist'" />

                        <x-status-radio name="role" value="admin" label="Admin" :checked="old('role', $user->getRoleNames()->first()) == 'admin'" />

                    </div>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-x-4 mt-4">
                <a href="{{ route('users.show', $user) }}"
                    class="text-sm text-gray-800 hover:text-gray-900 font-semibold">
                    Cancel
                </a>

                <x-save-button type="submit">Update User</x-save-button>
            </div>

        </form>
    </x-card-container>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <x-card-container>
        <div class="mx-auto mt-2 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8 mb-6 ">
            <img src="{{ Str::startsWith($user->picture, 'http') ? $user->picture : asset('storage/' . $user->picture) }}"
                alt="{{ $user->name }}" class="size-32 flex-none rounded-full bg-gray-100" />
        </div>

        <h2 class="text-lg font-bold">{{ $user->name }}</h2>

        <p>E-mail: {{ $user->email }}</p>
        <p>Contact: {{ $user->contact}}</p>
        <p>Role: {{ $user->roles->pluck('name')->first() }}</p>


        @role('admin')
        <p class="mt-6">
            <a href="{{ route('users.edit', $user->id) }}">
                <x-edit-button>
                    Edit user
                </x-edit-button>
            </a>
        </p>
        @endrole

    </x-card-container>



</x-app-layout>
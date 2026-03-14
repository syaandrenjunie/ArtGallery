<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Listing') }}
        </h2>

       

    </div>
    </x-slot>

        <div class="mx-auto max-w-7xl px-4 pt-2 pb-6 sm:px-6 lg:px-8">

            

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div id="blade-user-list">
                    <x-stack-list>
                        @foreach ($users as $user)
                            <x-stack-item 
                                :title="$user->name" 
                                :subtitle="$user->email"
                                :description="$user->roles->pluck('name')->join(', ')"
                                :footer="$user->contact" 
                                :link="route('users.show', $user->id)" 
                            />
                        @endforeach
                    </x-stack-list>                   

                </div>           
            </div>
        </div>
</x-app-layout>
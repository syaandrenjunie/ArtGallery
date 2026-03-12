<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Purchase') }}
            </h2>
        </div>

        @role('user')
        <a href="{{ route('artists.create') }}">
            <x-primary-button>
                + Create Artist
            </x-primary-button>
        </a>
        @endrole
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 pt-2 pb-6 sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">

            <x-data-table>

                <!-- Table Header -->
                <x-slot name="head">
                    <th class="px-6 py-3 text-left font-semibold text-gray-900 ">Artwork Title</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-900 ">Username</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-900 ">Status</th>
                </x-slot>

                <!-- Table Body -->
                <x-slot name="body">

                    @foreach ($purchases as $purchase)
                        <tr>

                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $purchase->artwork->title }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $purchase->user->name }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                @if($purchase->status === 'to_ship')
                                    <span class="text-yellow-600 font-semibold">To be shipped</span>
                                @elseif($purchase->status === 'to_deliver')
                                    <span class="text-magenta-600 font-semibold">To be delivered</span>
                                @elseif($purchase->status === 'completed')
                                    <span class="text-green-600 font-semibold">Completed</span>
                                @elseif($purchase->status === 'cancelled')
                                    <span class="text-red-600 font-semibold">Cancelled</span>
                                @endif
                            </td>

                            <!-- Action Buttons -->
                            <td class="px-6 py-4 text-sm flex gap-2 items-center">

                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6 text-green-600">
                                        <path
                                            d="M6 3a3 3 0 0 0-3 3v1.5a.75.75 0 0 0 1.5 0V6A1.5 1.5 0 0 1 6 4.5h1.5a.75.75 0 0 0 0-1.5H6ZM16.5 3a.75.75 0 0 0 0 1.5H18A1.5 1.5 0 0 1 19.5 6v1.5a.75.75 0 0 0 1.5 0V6a3 3 0 0 0-3-3h-1.5ZM12 8.25a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5ZM4.5 16.5a.75.75 0 0 0-1.5 0V18a3 3 0 0 0 3 3h1.5a.75.75 0 0 0 0-1.5H6A1.5 1.5 0 0 1 4.5 18v-1.5ZM21 16.5a.75.75 0 0 0-1.5 0V18a1.5 1.5 0 0 1-1.5 1.5h-1.5a.75.75 0 0 0 0 1.5H18a3 3 0 0 0 3-3v-1.5Z" />
                                    </svg>

                                </a>

                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6 text-blue-500">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path
                                            d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>


                                </a>

                                <form method="POST" action="">
                                    @csrf
                                    @method('DELETE')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6 text-red-500">
                                        <path fill-rule="evenodd"
                                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </form>

                            </td>

                        </tr>
                    @endforeach

                </x-slot>

            </x-data-table>
        </div>
    </div>
</x-app-layout>
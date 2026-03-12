<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Purchase') }}
            </h2>
        </div>


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


                                <button command="show-modal" commandfor="dialog"
                                    class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10">Open
                                    dialog</button>
                                <el-dialog>
                                    <dialog id="dialog" aria-labelledby="dialog-title"
                                        class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                                        <el-dialog-backdrop
                                            class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                                        <div tabindex="0"
                                            class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                                            <el-dialog-panel
                                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <div class="sm:flex sm:items-start">
                                                        <div
                                                            class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                            <h3 id="dialog-title"
                                                                class="text-base font-semibold text-gray-900">Purchases
                                                                Details</h3>
                                                            <div class="mt-2">
                                                                <div
                                                                    class="mx-auto mt-2 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8 mb-6 ">
                                                                    <img src="{{ Str::startsWith($purchase->artwork->picture, 'http') ? $purchase->artwork->picture : asset('storage/' . $purchase->artwork->picture) }}"
                                                                        alt="{{ $purchase->artwork->title }}"
                                                                        class="size-32 flex-none bg-gray-100" />
                                                                </div>

                                                                <h2 class="text-md font-semibold mb-3">
                                                                    {{$purchase->artwork->title}} by
                                                                    {{ $purchase->artist->name }}</h2>

                                                                <span class="text-sm font-semibold text-blue-500 ">User
                                                                    Details</span>

                                                                <p>Name: {{$purchase->user->name}} </p>
                                                                <p>E-mail: {{ $purchase->user->email}}</p>
                                                                <p>Phone Number: {{ $purchase->user->contact}}</p>

                                                                <span
                                                                    class="text-sm font-semibold text-blue-500 mt-3 inline-block">Payment
                                                                    Details</span>
                                                                <p>Payment Type:{{ $purchase->payment_type}}</p>
                                                                <p>Account Number: {{ $purchase->account_number}}</p>
                                                                <p>Purchase Submitted at {{$purchase->created_at}}</p>

                                                                @if($purchase->status === 'to_ship')
                                                                    <span
                                                                        class="text-yellow-600 font-semibold mt-3 inline-block">To
                                                                        be shipped</span>
                                                                @elseif($purchase->status === 'to_deliver')
                                                                    <span
                                                                        class="text-magenta-600 font-semibold mt-3 inline-block">To
                                                                        be delivered</span>
                                                                @elseif($purchase->status === 'completed')
                                                                    <span
                                                                        class="text-green-600 font-semibold mt-3 inline-block">Completed</span>
                                                                @elseif($purchase->status === 'cancelled')
                                                                    <span
                                                                        class="text-red-600 font-semibold mt-3 inline-block">Cancelled</span>
                                                                @endif


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                    <a href="{{ route('purchases.edit', $purchase) }}">
                                                        <x-secondary-button>
                                                            Edit
                                                        </x-secondary-button>
                                                    </a>

                                                    <x-cancel-button command="close" commandfor="dialog"
                                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</x-cancel-button>
                                                </div>
                                            </el-dialog-panel>
                                        </div>
                                    </dialog>
                                </el-dialog>


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
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order History') }}
            </h2>
        </div>
    </x-slot>

  <div class="mx-auto max-w-7xl px-4 pt-2 pb-6 sm:px-6 lg:px-8 ">


            @if($purchases->count())

                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 mt-5">

                    @foreach($purchases as $purchase)

                        <a href="#" class="group">

                            {{-- Artwork Image --}}
                            <img src="{{ Str::startsWith($purchase->artwork->picture, 'http') ? $purchase->artwork->picture : asset('storage/' . $purchase->artwork->picture) }}"
                                alt="{{ $purchase->artwork->title }}"
                                class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8"
                            >

                            {{-- Artwork Title --}} 
                            <h3 class="mt-4 text-sm text-gray-700">
                                {{ $purchase->artwork->title }}
                            </h3>

                            {{-- Price --}}
                            <p class="mt-1 text-lg font-medium text-gray-900">
                                RM {{ number_format($purchase->artwork->price, 2) }}
                            </p>

                            {{-- Purchase Status --}}
                            <p class="mt-1 text-sm">

                                @if($purchase->status == 'pending')
                                    <span class="text-yellow-600 font-semibold">
                                        Pending
                                    </span>
                                @elseif($purchase->status == 'complete')
                                    <span class="text-green-600 font-semibold">
                                        Completed
                                    </span>
                                @else
                                    <span class="text-gray-500">
                                        {{ ucfirst($purchase->status) }}
                                    </span>
                                @endif

                            </p>

                        </a>

                    @endforeach

                </div>

                <div class="mt-10">
                    {{ $purchases->links() }}
                </div>

            @else

                <p class="text-gray-500 text-center">
                    You have not purchased any artwork yet.
                </p>

            @endif

        </div>
    </div>

</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Purchase {{ $purchase->artwork->title }} by {{ $purchase->artist->name }}
        </h2>
    </x-slot>

    <x-card-container>
        <form method="POST" action="{{ route('purchases.update', $purchase) }}">
            @csrf
            @method('PATCH')


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Artwork Title --}}
                <div>
                    <x-input-label for="artwork_title" class="mb-1">Artwork Title</x-input-label>
                    <x-text-input id="artwork_title" name="artwork_title" type="text" class="block w-full"
                        value="{{ $purchase->artwork->title }}" disabled />
                </div>

                {{-- Price --}}
                <div>
                    <x-input-label for="price" class="mb-1">Price</x-input-label>
                    <x-text-input id="price" name="price" type="number" step="0.01" class="block w-full"
                        value="{{ $purchase->artwork->price }}" disabled />
                </div>

                {{-- Artist Name --}}
                <div>
                    <x-input-label for="artist_name" class="mb-1">Artist Name</x-input-label>
                    <x-text-input id="artist_name" name="artist_name" type="text" class="block w-full"
                        value="{{ $purchase->artwork->artist->name }}" disabled />
                </div>
            </div>

            <span class="block mt-3 mb-2 text-md font-semibold text-blue-600">
                Customer Details
            </span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Customer Name --}}
                <div>
                    <x-input-label for="customer_name" class="mb-1">Your Name</x-input-label>
                    <x-text-input id="customer_name" name="customer_name" type="text" class="block w-full"
                        value="{{ auth()->user()->name }}" disabled />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" class="mb-1">Email Address</x-input-label>
                    <x-text-input id="email" name="email" type="email" class="block w-full"
                        value="{{ auth()->user()->email }}" disabled />
                </div>

                {{-- Contact --}}
                <div>
                    <x-input-label for="contact" class="mb-1">Contact Number</x-input-label>
                    <x-text-input id="contact" name="contact" type="text" class="block w-full"
                        value="{{ $purchase->user->contact }}" disabled />
                </div>
            </div>


            <span class="block mt-3 text-md mb-2 font-semibold text-blue-600">
                Payment Details
            </span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Payment Method --}}
                <div>
                    <x-input-label for="payment_method" class=" mb-1">Payment Method</x-input-label>
                    <select id="payment_method" name="payment_method"
                        class="block w-full border-gray-300 rounded-md shadow-sm" disabled>

                        <option value="">Select a payment method</option>

                        <option value="credit_card" {{ $purchase->payment_method == 'credit_card' ? 'selected' : '' }}>
                            Credit Card
                        </option>

                        <option value="paypal" {{ $purchase->payment_method == 'paypal' ? 'selected' : '' }}>
                            PayPal
                        </option>

                        <option value="bank_transfer" {{ $purchase->payment_method == 'bank_transfer' ? 'selected' : '' }}>
                            Bank Transfer
                        </option>

                    </select>
                </div>

                {{-- Acount Number --}}
                <div>
                    <x-input-label for="account_number" class="mb-1">Account Number</x-input-label>
                    <x-text-input id="account_number" name="account_number" type="text" class="block w-full"
                        value="{{ $purchase->account_number }}" disabled />
                </div>

                {{-- Payment Proof --}}
                <div>
                    <x-input-label class="mb-1">Payment Proof</x-input-label>

                    <a href="{{ asset('storage/' . $purchase->payment_proof) }}" class="text-blue-600 underline"
                        target="_blank">
                        View Payment Proof
                    </a>
                </div>

            </div>

            {{-- Status --}}
            <div class="sm:col-span-4 mt-3">
                <x-input-label>Status</x-input-label>

                <div class="flex gap-4 mt-2">
                    <x-status-radio name="status" value="to_ship" label="To ship" :checked="old('status', $purchase->status) == 'to_ship'" />

                    <x-status-radio name="status" value="to_deliver" label="To deliver" :checked="old('status', $purchase->status) == 'to_deliver'" />

                    <x-status-radio name="status" value="completed" label="Completed" :checked="old('status', $purchase->status) == 'completed'" />

                    <x-status-radio name="status" value="cancelled" label="Cancelled" :checked="old('status', $purchase->status) == 'cancelled'" />
                </div>

                @error('status')
                    <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 pt-4">
                <x-danger-button href="{{ route('purchases.list') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">Cancel</x-danger-button>
                <x-secondary-button type="submit">Submit Purchase</x-secondary-button>
            </div>
        </form>
    </x-card-container>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Purchase {{ $artwork->title }} by {{ $artwork->artist->name }}
        </h2>
    </x-slot>

    <x-card-container>
        <form id="purchase-form" action="{{ route('purchases.store', $artwork->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Artwork Title --}}
                <div>
                    <x-input-label for="artwork_title" class="mb-1">Artwork Title</x-input-label>
                    <x-text-input id="artwork_title" name="artwork_title" type="text" class="block w-full"
                        value="{{ $artwork->title }}" readonly />
                </div>

                {{-- Price --}}
                <div>
                    <x-input-label for="price" class="mb-1">Price</x-input-label>
                    <x-text-input id="price" name="price" type="number" step="0.01" class="block w-full"
                        value="{{ $artwork->price }}" readonly />
                </div>

                {{-- Artist Name --}}
                <div>
                    <x-input-label for="artist_name" class="mb-1">Artist Name</x-input-label>
                    <x-text-input id="artist_name" name="artist_name" type="text" class="block w-full"
                        value="{{ $artwork->artist->name }}" readonly />
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
                        value="{{ auth()->user()->name }}" readonly />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" class="mb-1">Email Address</x-input-label>
                    <x-text-input id="email" name="email" type="email" class="block w-full"
                        value="{{ auth()->user()->email }}" readonly />
                </div>

                {{-- Contact --}}
                <div>
                    <x-input-label for="contact" class="mb-1">Contact Number</x-input-label>
                    <x-text-input id="contact" name="contact" type="text" class="block w-full"
                        value="{{ auth()->user()->contact }}" readonly />
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
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">Select a payment method</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>

                {{-- Acount Number --}}
                <div>
                    <x-input-label for="account_number" class="mb-1">Account Number</x-input-label>
                    <x-text-input id="account_number" name="account_number" type="text" class="block w-full"
                        value="{{ auth()->user()->account_number }}" />
                </div>

                {{-- Payment Proof --}}
                <div>
                    <x-input-label for="payment_proof" class="mb-1">Payment Proof</x-input-label>
                    <input id="payment_proof" type="file" name="payment_proof" class="block w-full text-sm text-gray-700
                    file:mr-4 file:rounded-md file:border-0
                    file:bg-gray-100 file:px-4 file:py-2
                    file:text-sm file:font-semibold
                    hover:file:bg-gray-200" />
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 pt-4">
                <x-danger-button href="{{ route('artists.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">Cancel</x-danger-button>
                <x-secondary-button type="submit">Submit Purchase</x-secondary-button>
            </div>
        </form>
    </x-card-container>
</x-app-layout>
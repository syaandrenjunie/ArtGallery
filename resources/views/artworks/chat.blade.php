<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat with {{ $artist->name ?? 'Artist Name' }}
        </h2>
    </x-slot>

    <div class="bg-white h-[80vh] flex flex-col max-w-3xl mx-auto mt-6 rounded-lg shadow-lg overflow-hidden">
        <!-- Chat messages -->
        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">
            <!-- Artist message -->
            <div class="flex justify-start">
                <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg max-w-xs break-words">
                    Hello! Thanks for checking my artwork.
                    <span class="text-xs text-gray-500 block mt-1">10:05</span>
                </div>
            </div>

            <!-- User message -->
            <div class="flex justify-end">
                <div class="bg-blue-600 text-white px-4 py-2 rounded-lg max-w-xs break-words">
                    Hi! I’m interested in your painting.
                    <span class="text-xs text-gray-200 block mt-1">10:06</span>
                </div>
            </div>

            <!-- Artist message -->
            <div class="flex justify-start">
                <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg max-w-xs break-words">
                    Great! I can provide more details and pricing.
                    <span class="text-xs text-gray-500 block mt-1">10:07</span>
                </div>
            </div>

            <div class="flex justify-start">
                <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg max-w-xs break-words">
                    This artwork called as {{ $artwork->title }} The price is RM{{ number_format($artwork->price, 2) }}
                    <span class="text-xs text-gray-500 block mt-1">10:07</span>
                </div>
            </div>

            <!-- User message -->
            <div class="flex justify-end">
                <div class="bg-blue-600 text-white px-4 py-2 rounded-lg max-w-xs break-words">
                    Great deal. How to purchase this?
                    <span class="text-xs text-gray-200 block mt-1">10:09</span>
                </div>
            </div>

            <!-- Artist message with purchase button -->
            <div class="flex justify-start">
                <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg max-w-xs break-words">
                    You can purchase this artwork here:
                    <x-edit-button class="mt-2">
                        <a href="{{ route('purchases.create', ['artwork' => $artwork->id]) }}">Purchase Now</a>
                    </x-edit-button>
                    <span class="text-xs text-gray-500 block mt-1">10:10</span>
                </div>
            </div>
        </div>

        <!-- Input area -->
        <div class="border-t border-gray-200 p-4 flex space-x-2">
            <input type="text" placeholder="Type your message..."
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
            <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954 4.977a.75.75 0 0 0 1.04-.693V7.716a.75.75 0 0 0-1.04-.693L2.25 12zM21.75 12l-8.954 4.977a.75.75 0 0 1-1.04-.693V7.716a.75.75 0 0 1 1.04-.693L21.75 12z" />
                </svg>
                Send
            </button>
        </div>
    </div>
</x-app-layout>
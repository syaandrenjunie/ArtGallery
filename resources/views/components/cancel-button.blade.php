<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex w-full justify-center text-sm text-gray-600 hover:text-gray-900 ']) }}>
    {{ $slot }}
</button>


<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex w-full justify-center rounded-md bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-800sm:ml-3 sm:w-auto']) }}>
    {{ $slot }}
</button>

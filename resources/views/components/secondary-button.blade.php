<button {{ $attributes->merge([
'type' => 'button',
'class' => 'inline-flex items-center px-3 py-1 bg-lime-600 border border-lime-600 rounded-md font-semibold text-sm text-white tracking-widest shadow-sm hover:bg-lime-600 active:bg-lime-800 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
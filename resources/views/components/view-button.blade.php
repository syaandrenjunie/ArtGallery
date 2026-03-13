<button {{ $attributes->merge([
'type' => 'submit',
'class' => 'inline-flex items-center px-2.5 py-1.5 rounded-md bg-gray-950/5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
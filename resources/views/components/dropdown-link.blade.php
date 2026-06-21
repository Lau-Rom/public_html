<a
    {{ $attributes->merge([
        'class' =>
            'block w-full px-4 py-2 text-start text-sm leading-5 text-[#691c32] hover:bg-[#eee7dc] focus:outline-none focus:bg-[#eee7dc] transition duration-150 ease-in-out',
    ]) }}>
    {{ $slot }}
</a>

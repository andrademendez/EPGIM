<tr {{ $attributes->merge(['class' => 'hover:scale-y-105 hover:text-gray-800 hover:font-bold hover:shadow-lg cursor-auto
    transition duration-150 delay-75 hover:delay-0 ease-out hover:ease-in border-b border-gray-100 hover:bg-gray-50'])
    }}>
    {{ $slot }}
</tr>

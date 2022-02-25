<select {{ $attributes->merge(['class' => ' py-2 pl-3 pr-7 border border-indigo-300 bg-white rounded-lg
    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) }} >
    {{ $slot }}
</select>

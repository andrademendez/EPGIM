@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-2 font-medium text-xs text-gray-700 uppercase']) }}>
    {{ $value ?? $slot }}
</label>

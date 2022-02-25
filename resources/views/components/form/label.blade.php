@props(['value'])

<label {{ $attributes->merge(['class' => 'inline-block font-medium text-xs text-gray-500 uppercase']) }}>
    {{ $value ?? $slot }}
</label>

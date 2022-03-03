@props(['value'])

<label {{ $attributes->merge(['class' => 'inline-block font-medium text-xs text-gray-700 uppercase']) }}>
    {{ $value ?? $slot }}
</label>

@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-2 font-medium text-xs text-white uppercase']) }}>
    {{ $value ?? $slot }}
</label>

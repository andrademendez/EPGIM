@props(['active'])

@php
$classes = ($active ?? false)
? 'collapse active'
: 'collapse ';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

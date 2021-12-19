@props(['active'])

@php
$classes = ($active ?? false)
? 'nav-item active '
: 'nav-item ';
@endphp

<li {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</li>

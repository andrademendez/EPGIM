@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-lg shadow-sm border-indigo-400
focus:border-indigo-500 focus:ring-indigo-400 focus:ring-opacity-50 sm:text-sm']) !!}>

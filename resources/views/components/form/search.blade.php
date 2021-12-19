@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-lg px-4 py-1.5 shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-400 focus:ring-opacity-50 sm:text-sm']) !!}>

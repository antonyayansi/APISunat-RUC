@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-cyan-300 focus:ring-1 focus:ring-cyan-500 transition-all duration-200']) !!}>

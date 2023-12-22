@props(['disabled' => ''])

@php
$disabled = ($disabled === 'true' || $disabled === true) ? 'disabled' : '';

$classes = ($disabled === 'disabled')
            ? 'block w-full px-4 py-2 text-start text-sm leading-5 text-grey-900 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out cursor-not-allowed'
            : 'block w-full px-4 py-2 text-start text-sm leading-5 text-red-600 dark:text-red-600 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out';
@endphp

<button {{ $disabled }} {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>

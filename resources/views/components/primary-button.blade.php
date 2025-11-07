@props(['size' => 'md'])

@php
    $sizes = [
        'sm' => 'px-3 py-1 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
@endphp

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => "inline-flex items-center justify-center {$sizes[$size]} bg-black dark:bg-gray-200 border border-transparent rounded-md font-semibold text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
]) }}>
    {{ $slot }}
</button>

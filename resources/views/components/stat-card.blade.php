@props(['title', 'value', 'detail' => null, 'icon' => null, 'color' => 'gray'])

@php
    // Warna garis kiri
    $borderLeftColor = match($color) {
        'blue' => 'border-l-blue-500 hover:border-l-blue-600',
        'green' => 'border-l-green-500 hover:border-l-green-600',
        'red' => 'border-l-red-500 hover:border-l-red-600',
        'indigo' => 'border-l-indigo-500 hover:border-l-indigo-600',
        'yellow' => 'border-l-yellow-500 hover:border-l-yellow-600',
        default => 'border-l-gray-400 hover:border-l-gray-500',
    };

    // Warna teks utama
    $textColor = match($color) {
        'blue' => 'text-blue-600',
        'green' => 'text-green-600',
        'red' => 'text-red-600',
        'indigo' => 'text-indigo-600',
        'yellow' => 'text-yellow-600',
        default => 'text-gray-600',
    };

    // Warna background ikon bulat
    $iconBg = match($color) {
        'blue' => 'bg-blue-600 text-white',
        'green' => 'bg-green-600 text-white',
        'red' => 'bg-red-600 text-white',
        'indigo' => 'bg-indigo-600 text-white',
        'yellow' => 'bg-yellow-600 text-white',
        default => 'bg-gray-600 text-white',
    };

    // Path ikon (jika ada file SVG di public/icons/)
    $iconPath = public_path("icons/{$icon}.svg");
@endphp

<div {{ $attributes->merge([
    'class' => "bg-white p-4 rounded-xl shadow-md border-l-4 {$borderLeftColor} transition-all duration-200 hover:shadow-lg hover:scale-[1.02]"
]) }}>

    <div class="flex justify-between items-start">
        <h3 class="text-sm font-medium text-gray-700">{{ $title }}</h3>

        {{-- Ikon Bulat --}}
        <div class="p-2 rounded-full {{ $iconBg }} shadow-sm flex items-center justify-center w-8 h-8">
            @if ($icon && file_exists($iconPath))
                {!! file_get_contents($iconPath) !!}
            @else
                {{-- Default icon (Bell) --}}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.405L4 17h5m6 0v1a3 3 0 11-6 0v-1">
                    </path>
                </svg>
            @endif
        </div>
    </div>

    <div class="mt-2">
        <p class="text-2xl font-bold text-gray-900">{{ $value }}</p>
        @if ($detail)
            <p class="text-xs text-gray-500 mt-1">{{ $detail }}</p>
        @endif
    </div>
</div>

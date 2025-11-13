@props(['name', 'size' => 10])

@php
    use Illuminate\Support\Str;

    $initials = collect(explode(' ', $name))
        ->map(fn($word) => strtoupper(Str::substr($word, 0, 1)))
        ->join('');

    // Warna dinamis berdasarkan hash nama (biar tiap user beda warna)
    $colors = ['bg-blue-600', 'bg-green-600', 'bg-red-600', 'bg-yellow-600', 'bg-indigo-600', 'bg-pink-600', 'bg-purple-600'];
    $color = $colors[crc32($name) % count($colors)];
@endphp

<div class="w-{{ $size }} h-{{ $size }} rounded-full {{ $color }} flex items-center justify-center text-white font-semibold text-sm uppercase">
    {{ $initials }}
</div>

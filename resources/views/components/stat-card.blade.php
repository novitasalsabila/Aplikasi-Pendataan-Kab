@props(['title', 'value', 'color' => 'gray'])

<div
    class="p-6 rounded-lg shadow text-white
        @if($color === 'blue') bg-blue-600
        @elseif($color === 'green') bg-green-600
        @elseif($color === 'red') bg-red-600
        @elseif($color === 'yellow') bg-yellow-500
        @else bg-gray-200 text-gray-800 @endif">
    <h3 class="text-lg font-semibold">{{ $title }}</h3>
    <p class="text-3xl font-bold mt-2">{{ $value }}</p>
</div>

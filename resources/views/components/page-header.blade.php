<div class="flex items-start gap-3">
    {{-- Tombol panah kembali --}}
    <button type="button"
        onclick="history.back()"
        class="mt-1 inline-flex items-center justify-center p-1
            text-gray-700 hover:text-gray-900
            rounded-full hover:bg-gray-100 transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
            width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 19-7-7 7-7"/>
            <path d="M19 12H5"/>
        </svg>
    </button>

    {{-- Judul + Subjudul --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-0">
            {{ $title }}
        </h2>

        @if(isset($subtitle))
        <p class="text-sm text-gray-500">
            {{ $subtitle }}
        </p>
        @endif
    </div>
</div>

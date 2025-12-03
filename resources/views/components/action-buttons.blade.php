@props([
    'id',
    'showRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null,
    'fileRoute' => null,
    'itemName' => 'data',
])

<div class="flex items-center justify-center divide-x divide-gray-300">

    {{-- Tombol Lihat --}}
    @if($showRoute)
        <a href="{{ $showRoute }}" 
           class="text-blue-500 hover:text-blue-700 inline-flex items-center px-3">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639
                    C3.423 7.51 7.36 4.5 12 4.5
                    c4.638 0 8.573 3.007 9.963 7.178
                    .07.207.07.431 0 .639
                    C20.577 16.49 16.64 19.5 12 19.5
                    c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </a>
    @endif

    {{-- Tombol Lihat Dokumen--}}
    @if($fileRoute)
        <a href="{{ $fileRoute }}"
        target="_blank"
        class="text-blue-500 hover:text-blue-700 inline-flex items-center px-3">

            <svg xmlns="http://www.w3.org/2000/svg" 
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639
                    C3.423 7.51 7.36 4.5 12 4.5
                    c4.638 0 8.573 3.007 9.963 7.178
                    .07.207.07.431 0 .639
                    C20.577 16.49 16.64 19.5 12 19.5
                    c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

        </a>
    @endif



    {{-- Tombol Edit --}}
    @if($editRoute)
        <a href="{{ $editRoute }}"
           class="text-yellow-500 hover:text-yellow-700 inline-flex items-center px-3">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652
                    L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18
                    l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z
                    M19.5 7.125 16.862 4.487M18 14v4.75
                    A2.25 2.25 0 0 1 15.75 21H5.25
                    A2.25 2.25 0 0 1 3 18.75V8.25
                    A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </a>
    @endif


    {{-- Tombol Hapus --}}
    @if($deleteRoute)
        <button type="button"
            onclick="openConfirmModal('{{ $id }}')"
            class="text-red-500 hover:text-red-700 inline-flex items-center px-3">
            <svg xmlns="http://www.w3.org/2000/svg" 
                fill="none" viewBox="0 0 24 24" 
                stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="m14.74 9-.346 9m-4.788 0L9.26 9
                    m9.968-3.21c.342.052.682.107 1.022.166
                    m-1.022-.165L18.16 19.673
                    a2.25 2.25 0 0 1-2.244 2.077H8.084
                    a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79
                    m14.456 0a48.108 48.108 0 0 0-3.478-.397
                    m-12 .562c.34-.059.68-.114 1.022-.165
                    m0 0a48.11 48.11 0 0 1 3.478-.397
                    m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201
                    a51.964 51.964 0 0 0-3.32 0
                    c-1.18.037-2.09 1.022-2.09 2.201v.916" />
            </svg>
        </button>

        {{-- Modal Konfirmasi --}}
        <div id="modal-{{ $id }}"
            class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            
            <div class="bg-white rounded-xl shadow-lg p-6 w-[90%] max-w-[400px] text-center animate-fadeIn">
                <h4 class="text-md font-semibold mb-2">Konfirmasi Hapus</h4>
                <p class="text-gray-700 mb-4">
                    Yakin ingin menghapus <strong>{{ $itemName }}</strong>?
                </p>

                <div class="flex justify-center gap-2">
                    <form action="{{ $deleteRoute }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Ya, Hapus
                        </button>
                    </form>

                    <button onclick="closeConfirmModal('{{ $id }}')"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                        Batal
                    </button>
                </div>
            </div>

        </div>

    @endif
</div>

{{-- Script --}}
<script>
function openConfirmModal(id) {
    document.getElementById('modal-' + id).classList.remove('hidden');
}
function closeConfirmModal(id) {
    document.getElementById('modal-' + id).classList.add('hidden');
}
</script>

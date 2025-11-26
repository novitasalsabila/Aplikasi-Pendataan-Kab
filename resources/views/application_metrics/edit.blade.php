<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <form action="{{ route('application_metrics.store') }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div>
                <!-- Header -->
        <div class="relative mb-6">
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Tambah Monitoring Baru
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Lengkapi informasi Monitoring di bawah ini') }} 
                </p>

            </div>
        </div>

            <div>
                <label class="block font-medium mb-1">Nama Aplikasi *</label>
                <select name="application_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($metric->application_id == $app->id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal dan Waktu Pengecekan *</label>
                <input type="datetime-local" name="check_date"
                       value="{{ \Carbon\Carbon::parse($metric->check_date)->format('Y-m-d\TH:i') }}"
                       required class="w-full border rounded p-2 dark:bg-gray-700">
            </div>

                <div>
                    <label class="block font-medium mb-1">Uptime (%) *</label>
                    <input type="number" step="0.01" name="uptime" value="{{ $metric->uptime }}"
                           class="w-full border rounded p-2 dark:bg-gray-700">
                </div>
                <div>
                    <label class="block font-medium mb-1">Response Time (detik) *</label>
                    <input type="number" step="0.001" name="response_time" value="{{ $metric->response_time }}"
                           class="w-full border rounded p-2 dark:bg-gray-700">
                </div>
                <div>
                    <label class="block font-medium mb-1">Status *</label>
                    <select name="status" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="normal" @selected($metric->status == 'normal')>Normal</option>
                        <option value="lambat" @selected($metric->status == 'lambat')>Lambat</option>
                        <option value="down" @selected($metric->status == 'down')>Down</option>
                    </select>
                </div>


            <div>
                <label class="block font-medium mb-1">Catatan</label>
                <textarea name="note" rows="3"
                          class="w-full border rounded p-2 dark:bg-gray-700">{{ $metric->note }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_metrics.index') }}"
                class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition no-underline flex items-center gap-2">
                    <span>Batal</span>
                </a>
                <button type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

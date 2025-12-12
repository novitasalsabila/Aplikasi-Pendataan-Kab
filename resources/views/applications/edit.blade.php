<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        
        <form action="{{ route('applications.update', $application->id) }}" method="POST"
            class="space-y-8 bg-white shadow-md rounded-lg p-8">
            @csrf
            @method('PUT')

            <!-- HEADER -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Aplikasi</h2>
                <p class="text-sm text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi aplikasi di bawah ini.
                </p>
            </div>

            <!-- NAMA -->
            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <input type="text" name="name" value="{{ $application->name }}" required
                    class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700">
            </div>

            <!-- KATEGORI & DATA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="category"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        @foreach (['web', 'mobile', 'desktop'] as $cat)
                            <option value="{{ $cat }}" @selected($application->category == $cat)>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-1">Sensitivitas Data</label>
                    <select name="data_sensitivity"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        @foreach (['publik', 'internal', 'rahasia'] as $sens)
                            <option value="{{ $sens }}" @selected($application->data_sensitivity == $sens)>
                                {{ ucfirst($sens) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="3"
                        class="w-full border rounded-lg p-2.5 text-sm text-gray-700">{{ $application->description }}</textarea>
            </div>

            <!-- OPD, DEV, SERVER -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label class="block font-medium mb-1">OPD</label>
                    <select name="department_id"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" @selected($application->department_id == $dept->id)>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-1">Developer</label>
                    <select name="developer_id"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="">-- Kosong --</option>
                        @foreach ($developers as $dev)
                            <option value="{{ $dev->id }}" @selected($application->developer_id == $dev->id)>
                                {{ $dev->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-1">Server</label>
                    <select name="server_id"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="">-- Kosong --</option>
                        @foreach ($servers as $srv)
                            <option value="{{ $srv->id }}" @selected($application->server_id == $srv->id)>
                                {{ $srv->hostname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- STATUS + VERSION -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block font-medium mb-1">Status</label>
                    <select name="status"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        @foreach (['aktif', 'nonaktif', 'perbaikan'] as $st)
                            <option value="{{ $st }}" @selected($application->status == $st)>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block font-medium mb-1">Versi Aplikasi</label>
                        <input type="text" name="version_code"
                            value="{{ $latestVersion->version_code ?? '' }}"
                            class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700">
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Tanggal Rilis</label>
                        <input type="date" name="release_date"
                        value="{{ $latestVersion?->created_at ? $latestVersion->created_at->format('Y-m-d') : '' }}"
                        class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700">
                    </div>

                </div>
            </div>

            <!-- CHANGELOG -->
            <div>
                <label class="block font-medium mb-1">Catatan Versi</label>
                <textarea name="changelog" rows="3"
                        class="w-full border rounded-lg p-2.5 text-sm text-gray-700">{{ $latestVersion->changelog ?? '' }}</textarea>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-3">
                <a href="{{ route('applications.index') }}"
                class="bg-gray-200 no-underline text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Kembali
                </a>
                <button type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    Simpan
                </button>
            </div>

        </form>

    </div>
    
</x-app-layout>

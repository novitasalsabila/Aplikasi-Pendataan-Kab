<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">✏️ Edit Aplikasi</h2>

        <form action="{{ route('applications.update', $application->id) }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <input type="text" name="name" value="{{ $application->name }}" required
                       class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded p-2 dark:bg-gray-700">{{ $application->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="category" class="w-full border rounded p-2 dark:bg-gray-700">
                        @foreach (['web', 'mobile', 'desktop'] as $cat)
                            <option value="{{ $cat }}" {{ $application->category == $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Sensitivitas Data</label>
                    <select name="data_sensitivity" class="w-full border rounded p-2 dark:bg-gray-700">
                        @foreach (['publik', 'internal', 'rahasia'] as $sens)
                            <option value="{{ $sens }}" {{ $application->data_sensitivity == $sens ? 'selected' : '' }}>
                                {{ ucfirst($sens) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium mb-1">OPD</label>
                    <select name="department_id" class="w-full border rounded p-2 dark:bg-gray-700">
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $application->department_id == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Developer</label>
                    <select name="developer_id" class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Kosong --</option>
                        @foreach ($developers as $dev)
                            <option value="{{ $dev->id }}" {{ $application->developer_id == $dev->id ? 'selected' : '' }}>
                                {{ $dev->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Server</label>
                    <select name="server_id" class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Kosong --</option>
                        @foreach ($servers as $srv)
                            <option value="{{ $srv->id }}" {{ $application->server_id == $srv->id ? 'selected' : '' }}>
                                {{ $srv->hostname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Status</label>
                    <select name="status" class="w-full border rounded p-2 dark:bg-gray-700">
                        @foreach (['aktif', 'nonaktif', 'maintenance'] as $st)
                            <option value="{{ $st }}" {{ $application->status == $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Terakhir Update</label>
                    <input type="date" name="last_update" value="{{ $application->last_update }}"
                           class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('applications.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>

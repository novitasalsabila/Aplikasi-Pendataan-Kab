<table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
      <thead class="bg-white text-gray-800 border-b border-gray-200">
          <tr>
              <th class="px-4 py-3 text-center w-10">No</th>
              <th class="px-4 py-3 text-left   min-w-[250px]">Aplikasi</th>
              <th class="px-4 py-3 text-left  min-w-[400px]">Deskripsi</th>
              <th class="px-4 py-3 text-center w-28">Status</th>
              <th class="px-4 py-3 text-center w-20">Tipe</th>
              <th class="px-4 py-3 text-center w-24">Tingkat</th>
              <th class="px-4 py-3 text-left min-w-[180px]">Sumber</th>
              <th class="px-4 py-3 text-left   min-w-[180px]">Tindak Lanjut</th>
              <th class="px-4 py-3 text-left min-w-[180px]">Tanggal Ditemukan</th>
              <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
      </thead>

      <tbody>
          @forelse ($findings as $index => $f)
              <tr class="border-b border-gray-200 hover:bg-gray-50">
                  <td class="px-3 py-3 text-center align-middle">
                      {{ $index + 1 }}
                  </td>

                  <td class="px-4 py-3 align-middle">
                      {{ $f->application->name ?? '-' }}
                  </td>

                  <td class="px-4 py-3 align-middle ">
                      {{ Str::limit($f->description, 100) }}
                  </td>

                  <td class="px-4 py-3 text-center align-middle">
                      @php
                          $status = strtolower($f->status);

                          $styles = [
                              'baru' => 'bg-red-100 text-red-600',
                              'diproses' => 'bg-yellow-100 text-yellow-600',
                              'selesai' => 'bg-blue-100 text-blue-600',
                          ];

                          $class = $styles[$status] ?? 'bg-gray-100 text-gray-600';
                      @endphp

                      <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $class }}">
                          {{ ucfirst($status) }}
                      </span>
                  </td>

                  <td class="px-4 py-3 text-center align-middle">
                  @php
                      $type = strtolower($f->type);

                      $styles = [
                          'bug' => 'bg-red-100 text-red-700',
                          'kerentanan' => 'bg-yellow-100 text-yellow-600',
                          'peretasan' => 'bg-purple-100 text-purple-600',
                      ];
                  @endphp

                  <span class="px-3 py-1 rounded-md text-xs font-semibold 
                      {{ $styles[$type] ?? 'bg-gray-100 text-gray-600' }}">
                      {{ ucfirst($type) }}
                  </span>
              </td>


                  <td class="px-4 py-3 text-center align-middle">
                      @php
                          $severity = strtolower($f->severity);

                          $styles = [
                              'tinggi' => 'bg-red-100 text-red-600',
                              'sedang' => 'bg-orange-100 text-orange-600',
                              'rendah' => 'bg-yellow-100 text-yellow-600',
                          ];

                          $class = $styles[$severity] ?? 'bg-gray-100 text-gray-600';
                      @endphp

                      <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $class }}">
                          {{ ucfirst($severity) }}
                      </span>
                  </td>


                  <td class="px-4 py-3 align-middle">
                      {{ ucfirst(str_replace('_', ' ', $f->source)) }}
                  </td>

                  <td class="px-4 py-3 align-middle">
                      {{ $f->follow_up_action ?? '-' }}
                  </td>

                  <td class="px-4 py-3">
                      {{ $f->follow_up_date
                          ? \Carbon\Carbon::parse($f->follow_up_date)->format('Y-m-d')
                          : '-' }}
                  </td>

                  <td class="px-4 py-3 text-center align-middle">
                      <x-action-buttons
                          :id="$f->id"
                          :editRoute="route('application_findings.edit', $f->id)"
                          :deleteRoute="route('application_findings.destroy', $f->id)"
                          itemName="{{ $f->application->name }}"
                      />
                  </td>
              </tr>
          @empty
              <tr>
                  <td colspan="10" class="px-4 py-6 text-center text-gray-500">
                      Belum ada data temuan aplikasi.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
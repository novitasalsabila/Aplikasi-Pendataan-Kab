<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Department;
use App\Models\Developer;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Models\ApplicationBackup;
use Carbon\Carbon;
use App\Models\ApplicationVersion;

class ApplicationController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        $search        = $request->input('search');
        $status        = $request->input('status');
        $kategori      = $request->input('kategori');
        $sensitivitas  = $request->input('sensitivitas');

        $applications = Application::with(['department', 'developer', 'server', 'versions'])

            // ROLE OPD → hanya data milik departemennya
            ->when($user->role === 'opd', function ($query) use ($user) {
                $query->where('department_id', $user->department_id);
            })

            // FILTER SEARCH
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                });
            })

            // FILTER STATUS
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })

            // FILTER KATEGORI
            ->when($kategori, function ($query) use ($kategori) {
                $query->where('category', $kategori);
            })

            // FILTER SENSITIVITAS
            ->when($sensitivitas, function ($query) use ($sensitivitas) {
                $query->where('data_sensitivity', $sensitivitas);
            })

            ->latest()
            ->get();

        return view('applications.index', compact('applications'));
    }


    /**
     * Form tambah aplikasi baru.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'opd') {
            abort(403, 'OPD tidak dapat menambahkan aplikasi.');
        }
        $departments = Department::all();
        $developers = Developer::all();
        $servers = Server::all();

        return view('applications.create', compact('departments', 'developers', 'servers'));
    }

    /**
     * Simpan data aplikasi baru.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'opd') {
            abort(403, 'OPD tidak dapat menambahkan aplikasi.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category' => 'required|in:web,mobile,desktop',
            'data_sensitivity' => 'required|in:publik,internal,rahasia',
            'department_id' => 'required|exists:departments,id',
            'developer_id' => 'nullable|exists:developers,id',
            'server_id' => 'nullable|exists:servers,id',
            'status' => 'required|in:aktif,nonaktif,dalam perbaikan',
            'last_update' => 'nullable|date',
        ]);

        $request->validate([
            'version_code' => 'nullable|string|max:50',
            'release_date' => 'nullable|date',
            'changelog'    => 'nullable|string',
        ]);

            // Simpan data aplikasi
    $application = Application::create($validated);
    if ($request->version_code) {
        ApplicationVersion::create([
            'application_id' => $application->id,
            'version_code'   => $request->version_code,
            'release_date'   => $request->release_date,
            'changelog'      => $request->changelog,
        ]);
    }
    // Jika admin/diskominfo → buat catatan backup otomatis
    if (in_array($user->role, ['admin', 'diskominfo'])) {
        ApplicationBackup::create([
            'application_id'   => $application->id,
            'backup_date'      => Carbon::now(),
            'backup_type'      => 'manual', // bisa kamu ubah jadi 'harian', 'mingguan', dll sesuai kebutuhan
            'storage_location' => 'local-storage/backup-' . $application->id, // contoh lokasi penyimpanan
            'verified_st'      => 'tidak',
        ]);
    }

        return redirect()->route('applications.index')
            ->with('success', 'Data aplikasi berhasil ditambahkan.');
    }

    /**
     * Form edit aplikasi.
     */
    public function edit(Application $application)
    {
        $user = auth()->user();

        if ($user->role === 'opd') {
            abort(403, 'OPD tidak dapat mengedit aplikasi.');
        }

        $departments = Department::all();
        $developers = Developer::all();
        $servers = Server::all();
        $latestVersion = $application->versions()->latest('release_date')->first();


        return view('applications.edit', compact('application', 'departments', 'developers', 'servers','latestVersion'));
    }

    /**
     * Update data aplikasi.
     */
    public function update(Request $request, Application $application)
    {
        $user = auth()->user();

        if ($user->role === 'opd') {
            abort(403, 'OPD tidak dapat memperbarui aplikasi.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category' => 'required|in:web,mobile,desktop',
            'data_sensitivity' => 'required|in:publik,internal,rahasia',
            'department_id' => 'required|exists:departments,id',
            'developer_id' => 'nullable|exists:developers,id',
            'server_id' => 'nullable|exists:servers,id',
            'status' => 'required|in:aktif,nonaktif,dalam perbaikan',
            'last_update' => 'nullable|date',
        ]);

        $application->update($validated);
        // Update atau tambahkan versi terbaru
if ($request->version_code) {
    ApplicationVersion::create([
        'application_id' => $application->id,
        'version_code' => $request->version_code,
        'release_date'   => $request->release_date,
        'changelog'      => $request->changelog,
    ]);
}


            // Jika admin atau diskominfo → catat backup otomatis
    if (in_array($user->role, ['admin', 'diskominfo'])) {
    ApplicationBackup::updateOrCreate(
    ['application_id' => $application->id], // cari berdasarkan ID aplikasi
    [
        'backup_date'      => Carbon::now(),
        'backup_type'      => 'manual',
        'storage_location' => 'local-storage/update-backup-' . $application->id,
        'verified_st'      => 'tidak',
    ]
);

    }

        return redirect()->route('applications.index')
            ->with('success', 'Data aplikasi berhasil diperbarui.');
    }

    /**
     * Hapus aplikasi.
     */
    public function destroy(Application $application)
    {
        $user = auth()->user();

        if ($user->role === 'opd') {
            abort(403, 'OPD tidak dapat memperbarui aplikasi.');
        }

        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Data aplikasi berhasil dihapus.');
    }
        public function show($id)
    {
        // $application = Application::findOrFail($id); // ambil data berdasarkan id
        // return view('applications.show', compact('application'));
            $application = \App\Models\Application::with(['department', 'developer', 'server','versions'])->findOrFail($id);
    $user = auth()->user();

    if ($user->role === 'opd' && $application->department_id !== $user->department_id) {
        abort(403, 'Anda tidak memiliki akses ke aplikasi ini.');
    }

    return view('applications.show', compact('application'));
    }
}

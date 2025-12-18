<?php

namespace App\Http\Controllers;

use App\Models\ApplicationVersion;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationVersionController extends Controller
{
    /**
     * Tampilkan daftar versi aplikasi.
     */
    public function index()
    {
        $user = auth()->user();

    // Jika role OPD → tampilkan hanya versi aplikasi milik departemen OPD
    if ($user->role === 'opd') {
        $versions = ApplicationVersion::with('application')
            ->whereHas('application', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            })
            ->latest()
            ->get();
    } 
    // Selain OPD → tampilkan semua
    else {
        $versions = ApplicationVersion::with('application')->latest()->get();
    }
        return view('application_versions.index', compact('versions'));
    }

    /**
     * Tampilkan form tambah versi baru.
     */
    public function create()
    {
        $applications = Application::orderBy('name')->get();
        return view('application_versions.create', compact('applications'));
    }

    /**
     * Simpan versi aplikasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'version_code' => 'required|string|max:50',
            'release_date' => 'nullable|date',
            'changelog' => 'nullable|string',
        ]);

        ApplicationVersion::create($validated);

        return redirect()->route('application_versions.index')
            ->with('success', 'Versi aplikasi berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit versi aplikasi.
     */
    public function show($id)
{
    $user = auth()->user();

    // Ambil versi + relasi aplikasi
    $version = ApplicationVersion::with('application')->findOrFail($id);

    // OPD hanya boleh melihat versi aplikasi miliknya
    if ($user->role === 'opd') {
        if ($version->application->department_id !== $user->department_id) {
            abort(403, 'Anda tidak memiliki akses ke versi aplikasi ini.');
        }
    }

    return view('application_versions.show', compact('version'));
}

    public function edit(ApplicationVersion $application_version)
    {
        $applications = Application::orderBy('name')->get();
        return view('application_versions.edit', [
            'version' => $application_version,
            'applications' => $applications
        ]);
    }

    /**
     * Update versi aplikasi.
     */
    public function update(Request $request, ApplicationVersion $application_version)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'version_code' => 'required|string|max:50',
            'release_date' => 'nullable|date',
            'changelog' => 'nullable|string',
        ]);

        $application_version->update($validated);

        return redirect()->route('application_versions.index')
            ->with('success', 'Versi aplikasi berhasil diperbarui.');
    }

    /**
     * Hapus versi aplikasi.
     */
    public function destroy(ApplicationVersion $application_version)
    {
        $application_version->delete();

        return redirect()->route('application_versions.index')
            ->with('success', 'Versi aplikasi berhasil dihapus.');
    }
}

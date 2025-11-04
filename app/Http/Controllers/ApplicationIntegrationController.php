<?php

namespace App\Http\Controllers;

use App\Models\ApplicationIntegration;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationIntegrationController extends Controller
{
    /**
     * Tampilkan daftar integrasi antar aplikasi.
     */
    public function index()
    {
        $integrations = ApplicationIntegration::with(['sourceApp', 'targetApp'])->latest()->get();
        return view('application_integrations.index', compact('integrations'));
    }

    /**
     * Tampilkan form tambah integrasi.
     */
    public function create()
    {
        $applications = Application::orderBy('name')->get();
        $types = ['API', 'Database', 'File', 'Manual'];
        return view('application_integrations.create', compact('applications', 'types'));
    }

    /**
     * Simpan data integrasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'source_app_id' => 'required|different:target_app_id|exists:applications,id',
            'target_app_id' => 'required|exists:applications,id',
            'type' => 'required|in:API,Database,File,Manual',
            'description' => 'nullable|string',
        ]);

        ApplicationIntegration::create($validated);

        return redirect()->route('application_integrations.index')
            ->with('success', '✅ Data integrasi berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit integrasi.
     */
    public function edit(ApplicationIntegration $application_integration)
    {
        $applications = Application::orderBy('name')->get();
        $types = ['API', 'Database', 'File', 'Manual'];
        return view('application_integrations.edit', [
            'integration' => $application_integration,
            'applications' => $applications,
            'types' => $types
        ]);
    }

    /**
     * Update data integrasi.
     */
    public function update(Request $request, ApplicationIntegration $application_integration)
    {
        $validated = $request->validate([
            'source_app_id' => 'required|different:target_app_id|exists:applications,id',
            'target_app_id' => 'required|exists:applications,id',
            'type' => 'required|in:API,Database,File,Manual',
            'description' => 'nullable|string',
        ]);

        $application_integration->update($validated);

        return redirect()->route('application_integrations.index')
            ->with('success', '✏️ Data integrasi berhasil diperbarui.');
    }

    /**
     * Hapus data integrasi.
     */
    public function destroy(ApplicationIntegration $application_integration)
    {
        $application_integration->delete();

        return redirect()->route('application_integrations.index')
            ->with('success', '🗑️ Data integrasi berhasil dihapus.');
    }
}

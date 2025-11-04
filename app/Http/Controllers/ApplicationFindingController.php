<?php

namespace App\Http\Controllers;

use App\Models\ApplicationFinding;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationFindingController extends Controller
{
    /**
     * Menampilkan daftar temuan aplikasi
     */
    public function index()
    {
        $findings = ApplicationFinding::with('application')->latest()->get();
        return view('application_findings.index', compact('findings'));
    }

    /**
     * Form tambah data temuan
     */
    public function create()
    {
        $applications = Application::orderBy('name')->get();
        return view('application_findings.create', compact('applications'));
    }

    /**
     * Simpan data temuan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'type' => 'required|in:bug,vulnerability,hack,lainnya',
            'source' => 'required|in:user,monitoring,audit,laporan_masyarakat',
            'severity' => 'required|in:rendah,sedang,tinggi',
            'description' => 'required|string',
            'status' => 'required|in:open,in_progress,resolved',
            'follow_up_action' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
        ]);

        ApplicationFinding::create($validated);

        return redirect()->route('application_findings.index')
            ->with('success', '✅ Temuan aplikasi berhasil ditambahkan.');
    }

    /**
     * Form edit temuan
     */
    public function edit(ApplicationFinding $application_finding)
    {
        $applications = Application::orderBy('name')->get();
        return view('application_findings.edit', [
            'finding' => $application_finding,
            'applications' => $applications
        ]);
    }

    /**
     * Update data temuan
     */
    public function update(Request $request, ApplicationFinding $application_finding)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'type' => 'required|in:bug,vulnerability,hack,lainnya',
            'source' => 'required|in:user,monitoring,audit,laporan_masyarakat',
            'severity' => 'required|in:rendah,sedang,tinggi',
            'description' => 'required|string',
            'status' => 'required|in:open,in_progress,resolved',
            'follow_up_action' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
        ]);

        $application_finding->update($validated);

        return redirect()->route('application_findings.index')
            ->with('success', '✏️ Temuan aplikasi berhasil diperbarui.');
    }

    /**
     * Hapus data temuan
     */
    public function destroy(ApplicationFinding $application_finding)
    {
        $application_finding->delete();
        return redirect()->route('application_findings.index')
            ->with('success', '🗑️ Temuan aplikasi berhasil dihapus.');
    }
}

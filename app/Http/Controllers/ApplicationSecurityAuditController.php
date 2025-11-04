<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSecurityAudit;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationSecurityAuditController extends Controller
{
    /**
     * Tampilkan daftar audit keamanan.
     */
    public function index()
    {
        $audits = ApplicationSecurityAudit::with('application')->latest()->get();
        return view('application_audits.index', compact('audits'));
    }

    /**
     * Tampilkan form tambah audit baru.
     */
    public function create()
    {
        $applications = Application::orderBy('name')->get();
        return view('application_audits.create', compact('applications'));
    }

    /**
     * Simpan data audit baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'audit_date' => 'required|date',
            'auditor_name' => 'required|string|max:100',
            'risk_level' => 'required|in:rendah,sedang,tinggi',
            'summary' => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);

        ApplicationSecurityAudit::create($validated);

        return redirect()->route('application_audits.index')
            ->with('success', '✅ Data audit keamanan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit audit.
     */
    public function edit(ApplicationSecurityAudit $application_audit)
    {
        $applications = Application::orderBy('name')->get();
        return view('application_audits.edit', [
            'audit' => $application_audit,
            'applications' => $applications
        ]);
    }

    /**
     * Update data audit.
     */
    public function update(Request $request, ApplicationSecurityAudit $application_audit)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'audit_date' => 'required|date',
            'auditor_name' => 'required|string|max:100',
            'risk_level' => 'required|in:rendah,sedang,tinggi',
            'summary' => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);

        $application_audit->update($validated);

        return redirect()->route('application_audits.index')
            ->with('success', '✏️ Data audit keamanan berhasil diperbarui.');
    }

    /**
     * Hapus data audit.
     */
    public function destroy(ApplicationSecurityAudit $application_audit)
    {
        $application_audit->delete();

        return redirect()->route('application_audits.index')
            ->with('success', '🗑️ Data audit keamanan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationBackup;
use Illuminate\Http\Request;

class ApplicationBackupController extends Controller
{
    /**
     * Daftar semua backup aplikasi.
     */
    public function index()
    {
        $backups = ApplicationBackup::with('application')->latest()->get();
        return view('application_backups.index', compact('backups'));
    }

    /**
     * Form tambah backup baru.
     */
    public function create()
    {
        $applications = Application::all();
        return view('application_backups.create', compact('applications'));
    }

    /**
     * Simpan backup baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'backup_date' => 'required|date',
            'backup_type' => 'required|in:harian,mingguan,bulanan,manual',
            'storage_location' => 'required|string|max:255',
            'verified_st' => 'required|in:ya,tidak',
        ]);

        ApplicationBackup::create($validated);

        return redirect()->route('application_backups.index')
            ->with('success', 'Data backup berhasil ditambahkan.');
    }

    /**
     * Form edit backup.
     */
    public function edit(ApplicationBackup $application_backup)
    {
        $applications = Application::all();
        return view('application_backups.edit', [
            'backup' => $application_backup,
            'applications' => $applications
        ]);
    }

    /**
     * Update data backup.
     */
    public function update(Request $request, ApplicationBackup $application_backup)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'backup_date' => 'required|date',
            'backup_type' => 'required|in:harian,mingguan,bulanan,manual',
            'storage_location' => 'required|string|max:255',
            'verified_st' => 'required|in:ya,tidak',
        ]);

        $application_backup->update($validated);

        return redirect()->route('application_backups.index')
            ->with('success', 'Data backup berhasil diperbarui.');
    }

    /**
     * Hapus data backup.
     */
    public function destroy(ApplicationBackup $application_backup)
    {
        $application_backup->delete();

        return redirect()->route('application_backups.index')
            ->with('success', 'Data backup berhasil dihapus.');
    }
}

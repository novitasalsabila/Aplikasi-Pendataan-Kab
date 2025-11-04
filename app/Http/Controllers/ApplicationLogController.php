<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationLogController extends Controller
{
    /**
     * Tampilkan semua log aplikasi.
     */
    public function index()
    {
        $logs = ApplicationLog::with(['application', 'user', 'reviewer'])->latest()->get();
        return view('application_logs.index', compact('logs'));
    }

    /**
     * Form tambah log baru.
     */
    public function create()
    {
        $applications = Application::all();
        $reviewers = User::all();
        return view('application_logs.create', compact('applications', 'reviewers'));
    }

    /**
     * Simpan log baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'change_type' => 'required|in:penambahan,perbaikan,penghapusan,lainnya',
            'version' => 'nullable|string|max:50',
            'date' => 'nullable|date',
            'reviewed_by' => 'nullable|exists:users,id',
            'approved_st' => 'required|in:pending,approved,rejected',
        ]);

        $validated['user_id'] = Auth::id();

        ApplicationLog::create($validated);

        return redirect()->route('application_logs.index')
            ->with('success', '📝 Log aplikasi berhasil ditambahkan.');
    }

    /**
     * Form edit log.
     */
    public function edit(ApplicationLog $application_log)
    {
        $applications = Application::all();
        $reviewers = User::all();
        return view('application_logs.edit', [
            'log' => $application_log,
            'applications' => $applications,
            'reviewers' => $reviewers,
        ]);
    }

    /**
     * Update data log.
     */
    public function update(Request $request, ApplicationLog $application_log)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'change_type' => 'required|in:penambahan,perbaikan,penghapusan,lainnya',
            'version' => 'nullable|string|max:50',
            'date' => 'nullable|date',
            'reviewed_by' => 'nullable|exists:users,id',
            'approved_st' => 'required|in:pending,approved,rejected',
        ]);

        $application_log->update($validated);

        return redirect()->route('application_logs.index')
            ->with('success', '✅ Log aplikasi berhasil diperbarui.');
    }

    /**
     * Hapus log.
     */
    public function destroy(ApplicationLog $application_log)
    {
        $application_log->delete();

        return redirect()->route('application_logs.index')
            ->with('success', '🗑️ Log aplikasi berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationLog;
use App\Models\ApplicationVersion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationLogController extends Controller
{
    /**
     * Tampilkan semua log aplikasi.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->input('status');

        $logs = ApplicationLog::with(['application', 'user', 'application.versions' => fn($v) => $v->orderByDesc('id'), 'reviewer'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('application', function ($app) use ($search) {
                        $app->where('name', 'like', "%{$search}%");
                    });
                });
            })

            // FILTER STATUS
            ->when($status, function ($query) use ($status) {
                $query->where('approved_st', $status);
            })

            ->latest()
            ->get();

        return view('application_logs.index', compact('logs'));
    }

    /**
     * Form tambah log baru.
     */
    public function create()
    {
        $applications = Application::all();
        $reviewers = User::whereIn('role', ['admin', 'diskominfo'])->get();

        // Ambil versi terbaru tiap aplikasi
        $latestVersions = ApplicationVersion::select('application_id', 'version_code')
            ->latest('id')
            ->get()
            ->groupBy('application_id')
            ->map->first();

        return view('application_logs.create', compact('applications', 'reviewers', 'latestVersions'));
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
            'approved_st' => 'required|in:disetujui,diproses,ditolak',
        ]);

        $validated['user_id'] = Auth::id();

        ApplicationLog::create($validated);

        return redirect()->route('application_logs.index')
            ->with('success', 'Log aplikasi berhasil ditambahkan.');
    }

    /**
     * Form edit log.
     */
    public function edit(ApplicationLog $application_log)
    {
        $applications = Application::all();
        $reviewers = User::whereIn('role', ['admin', 'diskominfo'])->get();
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
            'approved_st' => 'required|in:disetujui,diproses,ditolak',
        ]);

        $application_log->update($validated);

        return redirect()->route('application_logs.index')
            ->with('success', 'Log aplikasi berhasil diperbarui.');
    }

    /**
     * Hapus log.
     */
    public function destroy(ApplicationLog $application_log)
    {
        $application_log->delete();

        return redirect()->route('application_logs.index')
            ->with('success', 'Log aplikasi berhasil dihapus.');
    }
}

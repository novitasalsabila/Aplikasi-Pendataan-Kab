<?php

namespace App\Http\Controllers;

use App\Models\ApplicationMetric;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationMetricController extends Controller
{
    /**
     * Menampilkan daftar metrik aplikasi
     */
    public function index()
    {
        $metrics = ApplicationMetric::with('application')->latest()->get();
        return view('application_metrics.index', compact('metrics'));
    }

    /**
     * Menampilkan form tambah metrik baru
     */
    public function create()
    {
        $applications = Application::orderBy('name')->get();
        return view('application_metrics.create', compact('applications'));
    }

    /**
     * Menyimpan data metrik aplikasi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'check_date' => 'required|date',
            'uptime' => 'nullable|numeric|min:0|max:100',
            'response_time' => 'nullable|numeric|min:0',
            'status' => 'required|in:normal,lambat,down',
            'note' => 'nullable|string',
        ]);

        ApplicationMetric::create($validated);

        return redirect()->route('application_metrics.index')
            ->with('success', '✅ Data metrik aplikasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit data metrik
     */
    public function edit(ApplicationMetric $application_metric)
    {
        $applications = Application::orderBy('name')->get();
        return view('application_metrics.edit', [
            'metric' => $application_metric,
            'applications' => $applications
        ]);
    }

    /**
     * Memperbarui data metrik aplikasi
     */
    public function update(Request $request, ApplicationMetric $application_metric)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'check_date' => 'required|date',
            'uptime' => 'nullable|numeric|min:0|max:100',
            'response_time' => 'nullable|numeric|min:0',
            'status' => 'required|in:normal,lambat,down',
            'note' => 'nullable|string',
        ]);

        $application_metric->update($validated);

        return redirect()->route('application_metrics.index')
            ->with('success', '✏️ Data metrik aplikasi berhasil diperbarui.');
    }

    /**
     * Menghapus data metrik aplikasi
     */
    public function destroy(ApplicationMetric $application_metric)
    {
        $application_metric->delete();

        return redirect()->route('application_metrics.index')
            ->with('success', '🗑️ Data metrik aplikasi berhasil dihapus.');
    }
}

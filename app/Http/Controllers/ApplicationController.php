<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Department;
use App\Models\Developer;
use App\Models\Server;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Tampilkan daftar semua aplikasi.
     */
    public function index()
    {
        $applications = Application::with(['department', 'developer', 'server'])
            ->latest()
            ->get();

        return view('applications.index', compact('applications'));
    }

    /**
     * Form tambah aplikasi baru.
     */
    public function create()
    {
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
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category' => 'required|in:web,mobile,desktop',
            'data_sensitivity' => 'required|in:publik,internal,rahasia',
            'department_id' => 'required|exists:departments,id',
            'developer_id' => 'nullable|exists:developers,id',
            'server_id' => 'nullable|exists:servers,id',
            'status' => 'required|in:aktif,nonaktif,maintenance',
            'last_update' => 'nullable|date',
        ]);

        Application::create($validated);

        return redirect()->route('applications.index')
            ->with('success', '✅ Data aplikasi berhasil ditambahkan.');
    }

    /**
     * Form edit aplikasi.
     */
    public function edit(Application $application)
    {
        $departments = Department::all();
        $developers = Developer::all();
        $servers = Server::all();

        return view('applications.edit', compact('application', 'departments', 'developers', 'servers'));
    }

    /**
     * Update data aplikasi.
     */
    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category' => 'required|in:web,mobile,desktop',
            'data_sensitivity' => 'required|in:publik,internal,rahasia',
            'department_id' => 'required|exists:departments,id',
            'developer_id' => 'nullable|exists:developers,id',
            'server_id' => 'nullable|exists:servers,id',
            'status' => 'required|in:aktif,nonaktif,maintenance',
            'last_update' => 'nullable|date',
        ]);

        $application->update($validated);

        return redirect()->route('applications.index')
            ->with('success', 'Data aplikasi berhasil diperbarui.');
    }

    /**
     * Hapus aplikasi.
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Data aplikasi berhasil dihapus.');
    }
        public function show($id)
    {
        $application = Application::findOrFail($id); // ambil data berdasarkan id
        return view('applications.show', compact('application'));
    }
}

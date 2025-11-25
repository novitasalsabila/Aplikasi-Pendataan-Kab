<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Tampilkan daftar semua server.
     */
    // public function index()
    // {
    //     $servers = Server::latest()->get();
    //     return view('servers.index', compact('servers'));
    // }
    public function index(Request $request)
    {
        $search = $request->search;

        $servers = Server::when($search, function ($query) use ($search) {
                $query->where('hostname', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhere('os', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('managed_by', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('servers.index', compact('servers'));
    }


    /**
     * Form tambah server.
     */
    public function create()
    {
        return view('servers.create');
    }

    /**
     * Simpan data server baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|ip',
            'os' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'managed_by' => 'nullable|string|max:150',
            'status' => 'required|in:aktif,nonaktif,maintenance',
        ]);

        Server::create($validated);

        return redirect()->route('servers.index')
            ->with('success', '✅ Data server berhasil ditambahkan.');
    }

    /**
     * Form edit server.
     */
    public function edit(Server $server)
    {
        return view('servers.edit', compact('server'));
    }

    /**
     * Update data server.
     */
    public function update(Request $request, Server $server)
    {
        $validated = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|ip',
            'os' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'managed_by' => 'nullable|string|max:150',
            'status' => 'required|in:aktif,nonaktif,maintenance',
        ]);

        $server->update($validated);

        return redirect()->route('servers.index')
            ->with('success', '✏️ Data server berhasil diperbarui.');
    }

    /**
     * Hapus server.
     */
    public function destroy(Server $server)
    {
        $server->delete();

        return redirect()->route('servers.index')
            ->with('success', '🗑️ Data server berhasil dihapus.');
    }
}

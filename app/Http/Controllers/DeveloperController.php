<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Tampilkan semua data pengembang.
     */
    public function index()
    {
        $developers = Developer::latest()->get();
        return view('developers.index', compact('developers'));
    }

    /**
     * Tampilkan form tambah.
     */
    public function create()
    {
        // enum options
        $types = ['internal', 'vendor', 'freelance'];
        return view('developers.create', compact('types'));
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'developer_type' => 'required|in:internal,vendor,freelance',
            'contract_number' => 'nullable|string|max:100',
            'contract_date' => 'nullable|date',
            'contact_email' => 'nullable|email|max:150',
            'contact_phone' => 'nullable|string|max:50',
        ]);

        Developer::create($validated);

        return redirect()->route('developers.index')
            ->with('success', '✅ Data pengembang berhasil ditambahkan.');
    }
        public function show($id)
    {
        // Ambil developer beserta daftar aplikasi yang dikembangkan (relasi ke OPD juga)
        $developer = Developer::with(['applications.department'])->findOrFail($id);

        return view('developers.show', compact('developer'));
    }
    /**
     * Tampilkan form edit.
     */
    public function edit(Developer $developer)
    {
        $types = ['internal', 'vendor', 'freelance'];
        return view('developers.edit', compact('developer', 'types'));
    }

    /**
     * Update data pengembang.
     */
    public function update(Request $request, Developer $developer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'developer_type' => 'required|in:internal,vendor,freelance',
            'contract_number' => 'nullable|string|max:100',
            'contract_date' => 'nullable|date',
            'contact_email' => 'nullable|email|max:150',
            'contact_phone' => 'nullable|string|max:50',
        ]);

        $developer->update($validated);

        return redirect()->route('developers.index')
            ->with('success', '✏️ Data pengembang berhasil diperbarui.');
    }

    /**
     * Hapus data pengembang.
     */
    public function destroy(Developer $developer)
    {
        $developer->delete();

        return redirect()->route('developers.index')
            ->with('success', '🗑️ Data pengembang berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Tampilkan daftar department
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('departments.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'nullable|email|max:150',
            'head_name' => 'nullable|string|max:100',
            'head_phone' => 'nullable|string|max:20',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Data OPD berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update data
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'nullable|email|max:150',
            'head_name' => 'nullable|string|max:100',
            'head_phone' => 'nullable|string|max:20',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Data OPD berhasil diperbarui!');
    }

    // Hapus data
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Data OPD berhasil dihapus!');
    }
}

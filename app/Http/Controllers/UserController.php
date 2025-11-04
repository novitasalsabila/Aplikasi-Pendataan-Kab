<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan semua pengguna.
     */
    public function index()
    {
        $users = User::with('department')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Tampilkan form tambah pengguna.
     */
    public function create()
    {
        $departments = Department::all();
        $roles = ['admin', 'discominfo', 'opd'];
        return view('users.create', compact('departments', 'roles'));
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'position' => 'nullable|string|max:100',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,discominfo,opd',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', '✅ Pengguna berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit pengguna.
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        $roles = ['admin', 'discominfo', 'opd'];
        return view('users.edit', compact('user', 'departments', 'roles'));
    }

    /**
     * Update data pengguna.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'position' => 'nullable|string|max:100',
            'role' => 'required|in:admin,discominfo,opd',
            'department_id' => 'nullable|exists:departments,id',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', '✅ Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', '🗑️ Pengguna berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationDocumentController extends Controller
{
    /**
     * Tampilkan daftar dokumen aplikasi
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'opd') {
            // Hanya ambil dokumen dari aplikasi milik OPD itu
            $documents = ApplicationDocument::with(['application', 'uploader'])
                ->whereHas('application', function ($q) use ($user) {
                    $q->where('department_id', $user->department_id);
                })
                ->latest()
                ->get();
        } else {
            // Admin/diskominfo → semua dokumen
            $documents = ApplicationDocument::with(['application', 'uploader'])
                ->latest()
                ->get();
        }
        return view('application_documents.index', compact('documents'));
    }

    /**
     * Form tambah dokumen
     */
    public function create()
    {
        $applications = Application::all();
        return view('application_documents.create', compact('applications'));
    }

    /**
     * Simpan dokumen baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'doc_name' => 'required|string|max:150',
            'doc_type' => 'required|in:tor,kontrak,manual,lainnya',
            'file_path' => 'required|file|mimes:pdf,docx,doc,xlsx,xls,pptx,ppt,txt|max:20000',
        ]);

        // Simpan file ke storage
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('documents', 'public');
        }

        $validated['uploaded_by'] = Auth::id();

        ApplicationDocument::create($validated);

        return redirect()->route('application_documents.index')
            ->with('success', '📄 Dokumen berhasil ditambahkan.');
    }

    /**
     * Form edit dokumen
     */
    public function edit(ApplicationDocument $application_document)
    {
        $applications = Application::all();
        return view('application_documents.edit', [
            'document' => $application_document,
            'applications' => $applications,
        ]);
    }

    /**
     * Update dokumen
     */
    public function update(Request $request, ApplicationDocument $application_document)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'doc_name' => 'required|string|max:150',
            'doc_type' => 'required|in:tor,kontrak,manual,lainnya',
            'file_path' => 'nullable|file|mimes:pdf,docx,doc,xlsx,xls,pptx,ppt,txt|max:2048',
        ]);

        // Update file jika ada upload baru
        if ($request->hasFile('file_path')) {
            // hapus file lama jika ada
            if ($application_document->file_path && file_exists(storage_path('app/public/' . $application_document->file_path))) {
                unlink(storage_path('app/public/' . $application_document->file_path));
            }

            $validated['file_path'] = $request->file('file_path')->store('documents', 'public');
        }

        $application_document->update($validated);

        return redirect()->route('application_documents.index')
            ->with('success', '✅ Dokumen berhasil diperbarui.');
    }

    /**
     * Hapus dokumen
     */
    public function destroy(ApplicationDocument $application_document)
    {
        if ($application_document->file_path && file_exists(storage_path('app/public/' . $application_document->file_path))) {
            unlink(storage_path('app/public/' . $application_document->file_path));
        }

        $application_document->delete();

        return redirect()->route('application_documents.index')
            ->with('success', '🗑️ Dokumen berhasil dihapus.');
    }

    /**
 * Unduh dokumen aplikasi (hanya untuk diskominfo)
 */
public function download($id)
{
    $document = ApplicationDocument::findOrFail($id);
    $user = Auth::user();

    // 🔒 Hanya role diskominfo yang boleh unduh
    if ($user->role !== 'diskominfo') {
        abort(403, 'Akses ditolak: hanya DISKOMINFO yang dapat mengunduh laporan.');
    }

    $filePath = storage_path('app/public/' . $document->file_path);

    if (!file_exists($filePath)) {
        return back()->with('error', 'File tidak ditemukan di server.');
    }

    return response()->download($filePath, $document->doc_name . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
}

}

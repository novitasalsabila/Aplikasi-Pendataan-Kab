<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    DepartmentController,
    DeveloperController,
    ApplicationController,
    ServerController,
    ApplicationBackupController,
    ApplicationDocumentController,
    ApplicationLogController,
    ApplicationSecurityAuditController,
    ApplicationVersionController,
    ApplicationIntegrationController,
    ApplicationMetricController,
    ApplicationFindingController,
    UserController,
    DashboardController
};

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================================
// AUTENTIKASI WAJIB
// ==========================================================
Route::middleware('auth')->group(function () {

    // Dashboard umum (redirect tergantung role di controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/documents/view/{filename}', function ($filename) {
    $path = storage_path('app/public/documents/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->middleware('auth')->name('documents.view');
// ==========================================================
// ROLE: ADMIN (Full Access)
// ==========================================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('developers', DeveloperController::class);
    Route::resource('servers', ServerController::class);
    Route::resource('applications', ApplicationController::class);
    Route::resource('application_backups', ApplicationBackupController::class);
    Route::resource('application_documents', ApplicationDocumentController::class);
    Route::resource('application_logs', ApplicationLogController::class);
    Route::resource('application_audits', ApplicationSecurityAuditController::class);
    Route::resource('application_integrations', ApplicationIntegrationController::class);
    Route::resource('application_metrics', ApplicationMetricController::class);
    Route::resource('application_findings', ApplicationFindingController::class);
    Route::resource('users', UserController::class);
    Route::resource('application_versions', ApplicationVersionController::class)->only(['index', 'create', 'store']);
});

// ==========================================================
// ROLE: DISKOMINFO (Akses teknis terbatas)
// ==========================================================
Route::middleware(['auth', 'role:diskominfo'])->group(function () {
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::resource('application_logs', ApplicationLogController::class)->except(['destroy']);
    Route::resource('application_findings', ApplicationFindingController::class)->only(['index', 'show', 'create','edit','update', 'store']);
    Route::resource('application_versions', ApplicationVersionController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('application_documents', ApplicationDocumentController::class)->only(['index']);
    Route::get('application_documents/{id}/download', [ApplicationDocumentController::class, 'download'])
        ->name('application_documents.download');
});

// ==========================================================
// ROLE: OPD (Read-only miliknya sendiri)
// ==========================================================
Route::middleware(['auth', 'role:opd'])->group(function () {
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::resource('application_versions', ApplicationVersionController::class)->only(['index', 'show']);
    Route::resource('application_documents', ApplicationDocumentController::class)->only(['index']);
    Route::get('application_documents/{id}/download', [ApplicationDocumentController::class, 'download'])->name('application_documents.download');
});

require __DIR__.'/auth.php';

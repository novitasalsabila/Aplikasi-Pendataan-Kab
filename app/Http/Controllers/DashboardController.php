<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationFinding;
use App\Models\ApplicationLog;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

    // 🔹 Filter aplikasi sesuai role
    $applications = Application::query();

    if ($user->role === 'opd') {
        // OPD hanya lihat aplikasi miliknya
        $applications->where('department_id', $user->department_id);

    } elseif ($user->role === 'diskominfo') {
        // DISKOMINFO → lihat semua aplikasi (TIDAK difilter)
    }

    // Statistik umum
    $totalApps = $applications->count();
    $activeApps = (clone $applications)->where('status', 'aktif')->count();

    // Status nonaktif versi lengkap
    $inactiveApps = (clone $applications)
        ->whereIn('status', ['nonaktif', 'non_aktif', 'non aktif'])
        ->count();

    // Temuan keamanan
    $findings = ApplicationFinding::query();

    // Tambahan statistik detail untuk dashboard cards
    $maintenanceApps = (clone $applications)
        ->whereIn('status', ['maintenance', 'pemeliharaan'])
        ->count();

    $departmentCount = Department::count();

    $activeUsersCount = \App\Models\User::count();

    $openCriticalFindings = ApplicationFinding::where('severity', 'tinggi')
        ->where('status', 'open')
        ->count();

    if ($user->role === 'opd') {
        $findings->whereHas('application', fn($q) =>
            $q->where('department_id', $user->department_id)
        );
    }
    // DISKOMINFO → tidak difilter, semua temuan tampil
    $findingsCount = $findings->count();

    // Log aktivitas
    $recentLogs = ApplicationLog::query()
        ->when($user->role === 'opd', fn($q) =>
            $q->whereHas('application', fn($a) =>
                $a->where('department_id', $user->department_id)
            )
        )
        // DISKOMINFO → lihat semua log
        ->latest()
        ->take(10)
        ->get();

    $recentAppUpdates = null;

    if ($user->role === 'diskominfo') {
        $recentAppUpdates = Application::with([
                'logs' => fn ($q) => $q->latest()->limit(1)
            ])
            ->whereHas('logs') // hanya aplikasi yg pernah diupdate
            ->get()
            ->map(function ($app) {
                $latestLog = $app->logs->first();

                return [
                    'name' => $app->name,
                    'status' => $app->status,
                    'updated_at' => $latestLog
                        ? $latestLog->created_at
                        : $app->created_at,
                ];
            });
    }


        $opdApplications = null;
        if ($user->role === 'opd') {
            $opdApplications = Application::where('department_id', $user->department_id)
                                            ->orderBy('name')
                                            ->get();
        }

        // Admin: tambahan data per OPD
        $appsPerDepartment = in_array($user->role, ['admin', 'diskominfo'])
        ? Department::withCount([
            'applications',
            'applications as active_applications_count' => function ($q) {
                $q->where('status', 'aktif');
            }
        ])
        ->having('applications_count', '>', 0) // hanya OPD yang punya aplikasi
        ->get()
        : null;



        // Temuan terbaru untuk admin & diskominfo
        $recentFindings = null;
        if (in_array($user->role, ['admin', 'diskominfo'])) {
            $recentFindings = ApplicationFinding::with('application')
                ->latest()
                ->take(5)
                ->get();
        }

        // Aktivitas terbaru
        $recentActivities = ApplicationLog::with('application.latestVersion')
            ->when($user->role === 'opd', function ($q) use ($user) {
                // OPD hanya lihat aktivitas aplikasi miliknya
                $q->whereHas('application', fn ($app) =>
                    $app->where('department_id', $user->department_id)
                );
            })
            // admin & diskominfo → lihat semua
            ->whereHas('application')
            ->latest()
            ->take(4) // SELALU 3 TERBARU
            ->get();


        // Return satu view saja
        return view('dashboard', compact(
            'totalApps',
            'activeApps',
            'inactiveApps',
            'maintenanceApps',       
            'departmentCount',       
            'activeUsersCount',      
            'openCriticalFindings', 
            'findingsCount',
            'recentLogs',
            'appsPerDepartment',
            'recentAppUpdates',
            'opdApplications',
            'recentActivities', 
            'recentFindings'   
        ));
    }
}

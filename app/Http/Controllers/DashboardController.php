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

    // 📊 Statistik umum
    $totalApps = $applications->count();
    $activeApps = (clone $applications)->where('status', 'aktif')->count();

    // Status nonaktif versi lengkap
    $inactiveApps = (clone $applications)
        ->whereIn('status', ['nonaktif', 'non_aktif', 'non aktif'])
        ->count();

    // 🐞 Temuan keamanan
    $findings = ApplicationFinding::query();

    if ($user->role === 'opd') {
        $findings->whereHas('application', fn($q) =>
            $q->where('department_id', $user->department_id)
        );
    }
    // DISKOMINFO → tidak difilter, semua temuan tampil
    $findingsCount = $findings->count();

    // 🧾 Log aktivitas
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

        $opdApplications = null;
        if ($user->role === 'opd') {
            $opdApplications = Application::where('department_id', $user->department_id)
                                            ->orderBy('name')
                                            ->get();
        }

        // 🏢 Admin: tambahan data per OPD
        $appsPerDepartment = $user->role === 'admin'
            ? Department::withCount('applications')->get()
            : null;

        // 💡 Return satu view saja
        return view('dashboard', compact(
            'totalApps',
            'activeApps',
            'inactiveApps',
            'findingsCount',
            'recentLogs',
            'appsPerDepartment',
            'opdApplications'
        ));
    }
}

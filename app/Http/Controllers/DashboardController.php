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
            $applications->where('department_id', $user->department_id);
        } elseif ($user->role === 'diskominfo') {
            $applications->where('developer_id', $user->id);
        }

        // 📊 Statistik umum
        $totalApps = $applications->count();
        $activeApps = (clone $applications)->where('status', 'aktif')->count();
        $inactiveApps = (clone $applications)->where('status', 'nonaktif')->count();

        // 🐞 Temuan keamanan
        $findings = ApplicationFinding::query();
        if ($user->role === 'opd') {
            $findings->whereHas('application', fn($q) => $q->where('department_id', $user->department_id));
        } elseif ($user->role === 'diskominfo') {
            $findings->whereHas('application', fn($q) => $q->where('developer_id', $user->id));
        }
        $findingsCount = $findings->count();

        // 🧾 Log aktivitas
        $recentLogs = ApplicationLog::query()
            ->when($user->role === 'opd', fn($q) =>
                $q->whereHas('application', fn($a) => $a->where('department_id', $user->department_id))
            )
            ->when($user->role === 'diskominfo', fn($q) =>
                $q->whereHas('application', fn($a) => $a->where('developer_id', $user->id))
            )
            ->latest()
            ->take(10)
            ->get();

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
            'appsPerDepartment'
        ));
    }
}

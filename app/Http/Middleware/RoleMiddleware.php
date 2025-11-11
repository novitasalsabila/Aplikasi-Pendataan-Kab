<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Kalau belum login
        if (!$user) {
            return redirect()->route('login');
        }

        $role = strtolower(trim($user->role));

        // Admin = akses penuh
        if ($role === 'admin') {
            return $next($request);
        }

        // Diskominfo: perlakuan khusus, boleh akses semua "application" routes
// Diskominfo: boleh akses semua route yang diawali dengan "application"
        if ($role === 'diskominfo' && str_starts_with($request->path(), 'application')) {
             return $next($request);
        }


        // Kalau role cocok dengan yang diizinkan
        $normalizedRoles = array_map(fn($r) => strtolower(trim($r)), $roles);
        if (in_array($role, $normalizedRoles)) {
            return $next($request);
        }

        // Kalau tidak cocok
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}

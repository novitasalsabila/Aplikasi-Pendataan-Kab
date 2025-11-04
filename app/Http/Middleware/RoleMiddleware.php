<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Jika belum login
        if (!$user) {
            return redirect()->route('login');
        }

        // Admin selalu punya akses penuh
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Cek apakah role user termasuk di daftar yang diizinkan
        if (in_array(strtolower($user->role), array_map('strtolower', $roles))) {
            return $next($request);
        }

        // Jika role tidak sesuai, tampilkan halaman error 403
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}

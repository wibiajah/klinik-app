<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Akun Anda tidak aktif. Hubungi administrator.');
        }

        // Jika ada parameter roles spesifik (seperti role:superadmin)
        if (!empty($roles)) {
            if (in_array($user->role, $roles)) {
                return $next($request);
            }
            return $this->redirectBasedOnRole($user);
        }

        // Permission-based checking untuk route tanpa parameter roles
        $routeName = $request->route()->getName();
        
        if ($user->canAccess($routeName)) {
            return $next($request);
        }

        return $this->redirectBasedOnRole($user);
    }

    private function redirectBasedOnRole($user)
    {
        $message = 'Anda tidak memiliki akses ke halaman ini.';
        
        switch ($user->role) {
            case 'superadmin':
            case 'admin':
            case 'karyawan':
                return redirect()->route('admin.dashboard')->with('error', $message);
            case 'user':
                return redirect()->route('user.dashboard')->with('error', $message);
            default:
                return redirect()->route('home')->with('error', $message);
        }
    }
}
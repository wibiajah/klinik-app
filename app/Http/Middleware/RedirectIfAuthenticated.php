<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                
                // Redirect berdasarkan role
                if ($user->role === 'Admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
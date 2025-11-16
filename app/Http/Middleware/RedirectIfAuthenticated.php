<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('dashboardAdmin');
            }
            
            return redirect()->route('dashboardUser');
        }

        return $next($request);
    }
}

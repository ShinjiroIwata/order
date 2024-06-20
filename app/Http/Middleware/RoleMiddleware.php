<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        // Adminはすべての役割にアクセス可能
        if ($user->role->name === 'admin' || $user->role->name === $role) {
            return $next($request);
        }

        return redirect('/');
    }
}

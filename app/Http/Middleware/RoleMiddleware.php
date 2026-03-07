<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        $userRole = $request->user()->role;
        
        foreach ($roles as $role) {
            if ($userRole === $role || $userRole === 'admin') {
                return $next($request);
            }
        }

        // If user doesn't have required role, redirect to dashboard
        return redirect('/dashboard')->with('error', 'You do not have permission to access this page.');
    }
}

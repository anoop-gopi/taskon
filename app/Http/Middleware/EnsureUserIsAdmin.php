<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !$user->is_admin) {
            return redirect()->route('admin.login')->with('error', 'Unauthorized access. Admin privileges required.');
        }

        return $next($request);
    }
}

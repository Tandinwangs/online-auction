<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the user is authenticated and an admin
       if (auth()->check() && auth()->user()->is_admin) {
        return $next($request);
    }

    // Redirect or abort if not an admin
    return redirect('/'); // Or abort(403); for a forbidden error
    }
}

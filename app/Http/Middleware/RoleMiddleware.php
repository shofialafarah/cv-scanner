<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user sama dengan role yang diminta (misal: 'hr')
        if (!$request->user() || $request->user()->role !== $role) {
            // Kalau nggak cocok, lempar ke dashboard dengan pesan error
            return redirect('/dashboard')->with('error', 'Waduh, area ini khusus ' . strtoupper($role) . ' ya!');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRoutesBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = Auth::user();

            if ($user->rol_id === 1) {
                return $next($request);
            }

            return redirect()->route('home');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return redirect()->route('home');
        }
    }
}

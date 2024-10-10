<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (Auth::check() && $request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        return Auth::check()
            ? response()->json(['message' => 'You do not have permission to perform this action.'], 403)
            : redirect()->route('login')->withErrors('You need to log in to access this page.');
    }
}

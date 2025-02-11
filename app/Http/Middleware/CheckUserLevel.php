<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        // Check if the user is authenticated and if their level is in the allowed list
        if (Auth::check() && in_array(Auth::user()->level, $levels)) {
            return $next($request);
        }

        // If the user doesn't have the required level, redirect them or show an error
        return redirect()->route('404')->with('error', 'You do not have access to this page.');
    }
}

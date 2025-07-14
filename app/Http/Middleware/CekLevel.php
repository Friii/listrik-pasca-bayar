<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$levels)
    {
        if (Auth::check() && in_array(Auth::user()->id_level, $levels)) {
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['akses' => 'Kamu tidak punya akses']);
    }
}


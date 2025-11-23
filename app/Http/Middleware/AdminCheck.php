<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        return $next($request);
    }
}

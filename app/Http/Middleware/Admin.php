<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is an admin
        if (auth()->user() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect if the user is not an admin
        return redirect()->route('dashboard');
    }
}

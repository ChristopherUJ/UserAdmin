<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Continue if user is an admin user
        if(auth()->user()->isAdmin()) {
            return $next($request);
        }
        // If not an admin user
        return redirect('home');
    }
}

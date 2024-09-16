<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $usertype): Response
    {
        if (auth()->check() && auth()->user()->usertype == $usertype) {
            return $next($request);
        }
        // Redirect if user doesn't have the required role
        return redirect('/'); 
    }
}

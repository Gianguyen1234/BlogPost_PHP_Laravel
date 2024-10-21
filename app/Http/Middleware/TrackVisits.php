<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Define admin routes (customize this array according to your application)
         $adminRoutes = [
            'admin', // Adjust this based on your actual admin route prefix
            'admin/*', // This will capture all routes that start with 'admin/'
        ];

        // Check if the request URL does not belong to admin routes
        foreach ($adminRoutes as $adminRoute) {
            if (Str::is($adminRoute, $request->path())) {
                return $next($request); // Skip logging visits for admin routes
            }
        }

        // Log the visit for non-admin routes
        Visit::create([
            'ip_address' => $request->ip(),
            'url' => $request->url(),
        ]);

        return $next($request);

    }
}

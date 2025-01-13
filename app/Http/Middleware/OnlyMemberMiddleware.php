<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyMemberMiddleware
{
    // Make middleware for member if it's member he can access if not denied.
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->exists("user")) {
            return $next($request);
        } else {
            return redirect("/");
        }
    }
}

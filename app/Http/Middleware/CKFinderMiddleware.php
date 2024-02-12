<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CKFinderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        config(['ckfinder.authentication' => function() use ($request) {
            return auth()->check() && auth()->user()->is_admin;
        }]);
        return $next($request);
    }
}

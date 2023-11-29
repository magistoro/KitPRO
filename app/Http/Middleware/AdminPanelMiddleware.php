<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!isset(auth()->user()->role_id) || (auth()->user()->role_id !== 2 && auth()->user()->role_id !== 3)) {
            return redirect()->route('home');
        }
        // return $next($request);
    }
}

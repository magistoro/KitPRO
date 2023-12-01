<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelMiddleware
{    
    public function handle(Request $request, Closure $next): Response
    {
        if (!isset(auth()->user()->role_id) || (auth()->user()->role_id !== Role::getAdminRoleID() && auth()->user()->role_id !== Role::getManagerRoleID())) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}

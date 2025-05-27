<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminGestionnaireMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check() || (!auth()->user()->hasRole('gestionnaire') && !auth()->user()->hasRole('admin') && !auth()->user()->hasRole('directeur'))){
            return redirect("/");
        }
        return $next($request);
    }
}

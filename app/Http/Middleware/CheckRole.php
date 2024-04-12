<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // verificar si el usuario está autenticado
        
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        // verificar si el usuario tiene el rol permitido
        foreach ($roles as $role) {
            if (auth()->user()->name === $role) {
                return $next($request);
            }
        }

        
        // Si el usuario no tiene el rol permitido, redirigir o retornar un error
        abort(403, 'Acceso no autorizado.');

    }
}

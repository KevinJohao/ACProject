<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($user->isAdmin()){
                    return redirect('/admin/dashboard');
                    //return redirect(RouteServiceProvider::HOME);
                } elseif ($user->isClient()){
                    return redirect('/cliente/dashboard');
                } elseif ($user->isEmployee()){
                    return redirect('/empleado/dashboard');
                }
             }
        }

        return $next($request);
    }
}

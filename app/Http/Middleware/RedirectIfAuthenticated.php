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
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard == "admin" && Auth::guard($guard)->check()) {
                    return redirect(route('admin.home'));
                }

                if ($guard == "ressource" && Auth::guard($guard)->check()) {
                    return redirect(route('ressource.home'));
                }

                if ($guard == "comptable" && Auth::guard($guard)->check()) {
                    return redirect(route('comptable.home'));
                }

                if ($guard == "commercial" && Auth::guard($guard)->check()) {
                    return redirect(route('commercial.home'));
                }

                if ($guard == "magasinier" && Auth::guard($guard)->check()) {
                    return redirect(route('magasinier.home'));
                }

                if ($guard == "geststock" && Auth::guard($guard)->check()) {
                    return redirect(route('geststock.home'));
                }

                if ($guard == "packauto" && Auth::guard($guard)->check()) {
                    return redirect(route('packauto.home'));
                }

                if ($guard == "secretaire" && Auth::guard($guard)->check()) {
                    return redirect(route('secretaire.home'));
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }
        
        return $next($request);
    }
}

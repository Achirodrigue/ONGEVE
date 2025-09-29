<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommercialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth()->check())
        {
            if (Auth()->user()->isvalide === 0)
            {
                Auth()->logout();

                $error = "votre compte a été suspendu, veuillez svp contacter les responsables de la plateforme";
                return redirect()->route('commercial.login')->with('error',$error);
            }
        }
        elseif (Auth()->check())
        {
            if (Auth()->user()->isvalide === 1)
            {
                return redirect()->intended(route('commercial.home'));
            }
        }
        return $next($request);
    }
}

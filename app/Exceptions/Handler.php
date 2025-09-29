<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if ($request->is('directeur/general') || $request->is('directeur/general/*')) {
            return redirect()->guest(route('admin.login'));
        }

        if ($request->is('ressource/humaine') || $request->is('ressource/humaine/*')) {
            return redirect()->guest(route('ressource.login'));
        }

        if ($request->is('comptable') || $request->is('comptable/*')) {
            return redirect()->guest(route('comptable.login'));
        }

        if ($request->is('commercial') || $request->is('commercial/*')) {
            return redirect()->guest(route('commercial.login'));
        }

        if ($request->is('magasinier') || $request->is('magasinier/*')) {
            return redirect()->guest(route('magasinier.login'));
        }

        if ($request->is('pack/auto') || $request->is('pack/auto/*')) {
            return redirect()->guest(route('packauto.login'));
        }

        if ($request->is('gestionnnaire/stock') || $request->is('gestionnnaire/stock/*')) {
            return redirect()->guest(route('geststock.login'));
        }

        if ($request->is('secretaire') || $request->is('secretaire/*')) {
            return redirect()->guest(route('secretaire.login'));
        }

        return redirect()->guest(route('secretaire.login'));
    }
}

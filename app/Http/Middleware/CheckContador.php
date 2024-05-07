<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckContador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            $user = Auth::user();
            // Verifica si el usuario tiene el rol de supervisor
            if ($user->rol === 'Contador') {
               
                // El usuario tiene el rol de supervisor, permite el acceso
                return $next($request);
            }
        }
        // El usuario no está autenticado o no tiene el rol de supervisor, devuelve un mensaje de error
       
        throw new AccessDeniedHttpException('Acceso denegado. Debes ser un Contador para acceder a esta página.');
        
    }
}

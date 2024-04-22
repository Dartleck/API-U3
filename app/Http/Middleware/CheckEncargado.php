<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckEncargado
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
            if ($user->rol === 'Encargado') {
               //dd($user->rol);
                // El usuario tiene el rol de supervisor, permite el acceso
                return $next($request);
            }
        }
        // El usuario no está autenticado o no tiene el rol de supervisor, devuelve un mensaje de error
       
        throw new AccessDeniedHttpException('Acceso denegado. Debes ser un Encargado para acceder a esta página.');
        
    }
}

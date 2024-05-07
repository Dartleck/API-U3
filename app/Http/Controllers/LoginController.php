<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Las credenciales son válidas, el usuario ha iniciado sesión
            // Redirige a la página de inicio correspondiente al rol del usuario
            return $this->redirectTo();
        } else {
            // Las credenciales son inválidas, guarda el mensaje de error en la sesión
            Session::flash('error_message', 'Credenciales incorrectas');
            return back();
        }
    }

    protected function redirectTo()
{
    $user = Auth::user();
    // Normaliza el nombre del rol del usuario a minúsculas
    $userRole = strtolower($user->rol);
   // dd($userRole);
    if ($userRole === 'encargado') { 
        return redirect(route('Encargado.home'));
    } elseif ($userRole === 'cliente') {
        return redirect(route('Cliente.home'));
    } elseif ($userRole === 'contador') {
        return redirect(route('Contador.home'));
    } elseif ($userRole === 'supervisor') {
        return redirect(route('Supervisor.home'));
    } elseif ($userRole === 'vendedor') {
        return redirect(route('Vendedor.home'));
    } else {
        return redirect(route('login')); // Cambiado a 'login' en lugar de 'showLogin'
    }
}

    
    public function logout(Request $request)
    {
        // Lógica para cerrar sesión
    }
}

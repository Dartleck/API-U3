<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class EncargadoController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del Encargado
        $encargado = Auth::user();
        return view('encargado.home',['encargado' => $encargado]);
    }
    public function showResetPasswordForm(User $usuario)
    {
        return view('reset_contraseña', ['usuario' => $usuario]);
    }
    public function resetPassword(Request $request, User $usuario)
{
    // Verificar si el usuario tiene un rol igual o inferior al del encargado
    $rolesPermitidos = ['Encargado', 'Cliente', 'Contador'];
    if (in_array($usuario->rol, $rolesPermitidos)) {
        // Validar la nueva contraseña proporcionada por el encargado
        $request->validate([
            'nueva_contraseña' => 'required|string|min:8',
        ]);

        // Establecer la nueva contraseña para el usuario
        $usuario->password = bcrypt($request->nueva_contraseña);
        $usuario->save();
        $rol = Auth::user()->rol;
        // Redirigir a alguna vista o ruta adecuada
        return redirect(route($rol.'.usuarios'));
    } else {
        // Redirigir con un mensaje de error si el usuario tiene un rol superior al del encargado
        return redirect()->back()->with('error', 'No tienes permiso para restablecer la contraseña de este usuario.');
    }
}

    
}

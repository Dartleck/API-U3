<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UsuariosController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = User::all();
    
        // Agrupar los usuarios por su rol
        $usuariosPorRol = $usuarios->groupBy('rol');
    
        return view('Usuarios', compact('usuariosPorRol'));
    }
    
    public function create()
    {
        $rol = Auth::user()->rol;
        return view('CrearNuevoUsuario', compact('rol'));
    }
    
    public function store(Request $request)
    {
        $rol = Auth::user()->rol;
        $routeName = $rol . '.usuarios';
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'rol' => 'required|in:supervisor,encargado,cliente,vendedor,contador', // Asegúrate de incluir todos los roles posibles
        ]);
        
        // Crear el nuevo usuario con los datos proporcionados
        $usuario = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
        ]);

        // Guardar el nuevo usuario en la base de datos
        $usuario->save();

        // Redireccionar a alguna vista o ruta adecuada
        return redirect()->route($routeName);
    }
    public function edit(User $usuario)
{
    return view('editarUsuarios', compact('usuario'));
}

public function update(Request $request, User $usuario)
{
    $rol = Auth::user()->rol;
    $routeName = $rol . '.usuarios';
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$usuario->id,
        'password' => 'required|string|min:8',
        'rol' => 'required|in:supervisor,encargado,cliente,vendedor,contador',
    ]);

    // Actualizar los datos del usuario
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    if ($request->password !== null) {
        $usuario->password = bcrypt($request->password);
    }
    $usuario->rol = $request->rol;
    $usuario->save();

    // Redireccionar a alguna vista o ruta adecuada
    return redirect()->route($routeName);
}
public function destroy(User $usuario)
{
    $rol = Auth::user()->rol;
    $routeName = $rol . '.usuarios';
    // Eliminar al usuario de la base de datos
    $usuario->delete();

    // Redireccionar a alguna vista o ruta adecuada
    return redirect()->route($routeName)->with('success', 'Usuario eliminado exitosamente.');
}

}

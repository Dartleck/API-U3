<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Auth;
class RespuestaController extends Controller
{
    public function store(Request $request, Pregunta $pregunta)
    {
        // Validar los datos del formulario de respuesta
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);

        // Dentro del método store del controlador de RespuestaController
        $user_id = Auth::id(); // Obtener el ID del usuario autenticado
        Respuesta::create([
            'contenido' => $request->contenido,
            'pregunta_id' => $pregunta->id,
            'user_id' => $user_id, // Asignar el ID del usuario actual
        ]);
        // Redirigir de vuelta a la página de la pregunta original
        return redirect()->back()->with('success', '¡La respuesta se ha enviado correctamente!');
    }
}

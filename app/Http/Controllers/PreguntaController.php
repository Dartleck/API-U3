<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pregunta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class PreguntaController extends Controller
{
    public function crearPregunta(Request $request, $productoId)
    {
        $rol = Auth::user()->rol;
        // Validar los datos del formulario de pregunta
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);
    
        // Guardar la pregunta en la base de datos
        Pregunta::create([
            'contenido' => $request->contenido,
            'producto_id' => $productoId,
            'user_id' => auth()->user()->id,
        ]);
    
        // Redireccionar a la página del producto o mostrar un mensaje de éxito
        return redirect(route($rol.'.productos'));
    }
    
    public function obtenerPreguntas($productoId)
    {
        $rol = Auth::user()->rol;
        // Obtener todas las preguntas asociadas al producto
        $preguntas = Pregunta::where('producto_id', $productoId)->get();

        // Obtener información sobre el producto
        $producto = Producto::findOrFail($productoId);

        // Pasar las preguntas y la información del producto a la vista para mostrarlas al usuario
        return view('preguntas', compact('rol','preguntas', 'producto'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
class CategoriaController extends Controller
{
    
    public function index()
    {
        $categorias = Categoria::all();
        $rol = Auth::user()->rol;
        return view('categorias', compact('categorias','rol'));
    }
public function create()
{
    return view('agregarCategoria');
}

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255|unique:categorias,name', // Asegúrate de que el nombre sea único
    ]);

    // Crear la nueva categoría
    Categoria::create([
        'name' => $request->nombre,
    ]);

    // Redireccionar de vuelta a la página de categorías con un mensaje de éxito
    return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
}

public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
    }

}

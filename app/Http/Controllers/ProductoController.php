<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Transaccion;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Auth;
class ProductoController extends Controller
{
    public function index(Request $request)
{
    // Obtener todas las categorías disponibles
    $categorias = Categoria::all();
    $rol = Auth::user()->rol;

    // Obtener el ID de la categoría seleccionada (si existe)
    $categoriaId = $request->input('categoria_id');

    // Filtrar los productos por categoría si se selecciona una categoría
    if ($categoriaId) {
        $productos = Producto::where('category_id', $categoriaId)->get();
    } else {
        // Obtener todos los productos si no se selecciona una categoría
        $productos = Producto::all();
    }

    // Inicializar un array para almacenar las preguntas por producto
    $preguntasPorProducto = [];

    // Obtener las preguntas para cada producto y almacenarlas en el array asociativo
    foreach ($productos as $producto) {
        $preguntas = Pregunta::where('producto_id', $producto->id)->with('respuestas')->get();
        $preguntasPorProducto[$producto->id] = $preguntas;
    }

    return view('productos', compact('categorias', 'rol', 'productos', 'categoriaId', 'preguntasPorProducto','preguntas'));
}

public function misproductos(Request $request)
{
    // Obtener todas las categorías disponibles
    $categorias = Categoria::all();
    $usuario = Auth::user();

    $rol = $usuario->rol;

    // Obtener el ID de la categoría seleccionada (si existe)
    $categoriaId = $request->input('categoria_id');

    // Filtrar los productos por categoría y por usuario si se selecciona una categoría
    if ($categoriaId) {
        $productos = Producto::where('category_id', $categoriaId)->where('user_id', $usuario->id)->get();
        
    } else {
        // Obtener todos los productos del usuario si no se selecciona una categoría
        $productos = Producto::where('user_id', $usuario->id)->get();
    }

    // Inicializar un array para almacenar las preguntas por producto
    $preguntasPorProducto = [];

    // Obtener las preguntas para cada producto y almacenarlas en el array asociativo
    foreach ($productos as $producto) {
        $preguntas = Pregunta::where('producto_id', $producto->id)->with('respuestas')->get();
        $preguntasPorProducto[$producto->id] = $preguntas;
    }

    return view('productosv', compact('categorias', 'rol', 'productos', 'categoriaId', 'preguntasPorProducto'));
}

    
    

    public function create()
    {
        // Obtener todas las categorías disponibles
        $categorias = Categoria::all();
        $rol = Auth::user()->rol;
        $userId = auth()->user()->id;
    
        // Crear un nuevo modelo de producto en blanco
        $producto = new Producto();
    
        return view('crear_producto', compact('categorias', 'rol', 'userId', 'producto'));
    }
    
    
    public function store(Request $request)
{
    $rol = Auth::user()->rol;
    $routeName = $rol . '.home';
    
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0.01',
        'stock' => 'required|integer|min:1',
        'state' => 'required|in:pendiente', 
        'categoria_id' => 'required|exists:categorias,id',
    ]);
    
    $userId = auth()->user()->id;
    
    // Crear un nuevo producto con los datos del formulario y el ID del usuario actual
    $producto = new Producto([
        'name' => $request->nombre,
        'description' => $request->descripcion,
        'price' => $request->precio,
        'stock' => $request->stock,
        'state' => 'pendiente', 
        'category_id' => $request->categoria_id,
        'user_id' => $userId, // ID del usuario actual
    ]);
    $producto->save();

    // Registrar la transacción de publicación
    $transaccion = new Transaccion([
        'producto_id' => $producto->id,
        'user_id' => Auth::id(), // El ID del usuario que publica el producto
        'publicado' => true, // Marcar como publicado
    ]);
    $transaccion->save();

    // Redireccionar a la página de lista de productos
    return redirect()->route($routeName);
}


public function edit($id)
{
    // Encuentra el producto por su ID
    $producto = Producto::findOrFail($id);

    // Check if the product's state is 'aceptado' and the user's role is 'vendedor'
    if ($producto->state == 'aceptado' && Auth::user()->rol == 'Vendedor') {
        // Return a message or redirect the user
        
        return redirect()->back()->with('error' . $producto->id, 'No puedes editar un producto que ya ha sido aceptado.');
        
    }

    // Obtener todas las categorías disponibles
    $categorias = Categoria::all();
    $rol = Auth::user()->rol;
    // Retornar la vista de edición del producto con las categorías disponibles
    return view('editar_producto', compact('producto', 'categorias','rol'));
}


    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    
    public function update(Request $request, Producto $producto)
    {
         // Verificar si el producto ha sido comprado alguna vez
        if ($producto->transacciones()->where('comprado', true)->exists()) {
            // Si el producto ha sido comprado, no se puede modificar su estado
            // Puedes redirigir o mostrar un mensaje de error, según tu preferencia
            return redirect()->back()->with('error', 'No puedes modificar el estado de un producto que ha sido comprado.');
        }

        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'required|integer',
            'state' => 'required|in:aceptado,pendiente,rechazado',
            'categoria_id' => 'required|exists:categorias,id',
        ]);
    
        $rol = Auth::user()->rol;
        $routeName = $rol . '.productos';
    
        // Actualizar el producto con los datos del formulario
        $producto->update([
            'name' => $request->nombre,
            'description' => $request->descripcion,
            'price' => $request->precio,
            'stock' => $request->stock,
            'state' => $request->state,
            'category_id' => $request->categoria_id,
        ]);
    
         // Si el estado es "rechazado", guardamos la razón de rechazo
        if ($request->state === 'rechazado') {
            $producto->razon_rechazo = $request->razon_rechazo;
            $producto->save();
        }
        // Redireccionar a la página de detalles del producto
        return redirect()->route($routeName, $producto);
    }
    

public function destroy(Producto $producto)
{
    // Eliminar el producto
    $producto->delete();
    $rol = Auth::user()->rol;
    $routeName = $rol . '.productos';
    // Redireccionar a la página de lista de productos
    return redirect()->route($routeName);
}

public function kardex($id)
{
    // Obtener el producto por su ID
    $producto = Producto::findOrFail($id);

    // Obtener todas las transacciones asociadas con el producto
    $transacciones = $producto->transacciones;

    // Retornar la vista con el Kardex del producto y sus transacciones
    return view('kardex', compact('producto', 'transacciones'));
}


}

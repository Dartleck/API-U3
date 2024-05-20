<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Transaccion;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Auth;
use App\Models\FotoProducto;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ProductoComprado;
class ProductoController extends Controller
{

    public function anonimo(Request $request)
    {
        // Obtener todas las categorías disponibles
        $categorias = Categoria::all();

        // Obtener el ID de la categoría seleccionada (si existe)
        $categoriaId = $request->input('categoria_id');

        // Filtrar los productos por categoría y por estado "aceptado" si se selecciona una categoría
        if ($categoriaId) {
            $productos = Producto::where('category_id', $categoriaId)->where('state', 'aceptado')->get();
        } else {
            // Obtener todos los productos aceptados si no se selecciona una categoría
            $productos = Producto::where('state', 'aceptado')->get();
        }

        // Inicializar un array para almacenar las preguntas por producto
        $preguntasPorProducto = [];

        // Obtener las preguntas para cada producto y almacenarlas en el array asociativo
        foreach ($productos as $producto) {
            $preguntas = Pregunta::where('producto_id', $producto->id)->with('respuestas')->get();
            $preguntasPorProducto[$producto->id] = $preguntas;
        }

        return view('productosa', compact('categorias', 'productos', 'categoriaId', 'preguntasPorProducto'));
    }

    public function index(Request $request)
    {
        // Obtener todas las categorías disponibles
        $categorias = Categoria::all();
        $rol = Auth::user()->rol;

        // Obtener el ID de la categoría seleccionada (si existe)
        $categoriaId = $request->input('categoria_id');

        // Filtrar los productos por categoría y por estado "aceptado" si se selecciona una categoría
        if ($categoriaId) {
            $productos = Producto::where('category_id', $categoriaId)->where('state', 'aceptado')->get();
        } else {
            // Obtener todos los productos aceptados si no se selecciona una categoría
            $productos = Producto::where('state', 'aceptado')->get();
        }

        // Inicializar un array para almacenar las preguntas por producto
        $preguntasPorProducto = [];

        // Obtener las preguntas para cada producto y almacenarlas en el array asociativo
        foreach ($productos as $producto) {
            $preguntas = Pregunta::where('producto_id', $producto->id)->with('respuestas')->get();
            $preguntasPorProducto[$producto->id] = $preguntas;
        }

        return view('productos', compact('categorias', 'rol', 'productos', 'categoriaId', 'preguntasPorProducto'));
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
        
        return redirect()->back()->with('error' . $producto->id, 'No puedes editar tu producto que ya ha sido aceptado.');
        
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
    // Si el producto ha sido comprado, agregar un mensaje de error
    return redirect()->back()->withErrors(['estado_comprado' => 'No puedes modificar el estado de un producto que ha sido comprado.']);
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

        // Eliminar las preguntas asociadas al producto
        $producto->preguntas()->delete();
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

    // Contar el número de preguntas realizadas sobre el producto
    $numPreguntas = $producto->preguntas()->count();

    // Contar el número de personas que han comprado el producto
    $numCompras = $transacciones->where('comprado', true)->count();

    // Retornar la vista con el Kardex del producto y sus transacciones
    return view('kardex', compact('producto', 'transacciones', 'numPreguntas', 'numCompras'));
}
public function realizarCompra(Request $request, Producto $producto)
{
    $user = Auth::user();

    if ($request->cantidad > $producto->stock) {
        return redirect()->back()->with('error', 'No hay suficiente stock disponible para esta compra.');
    }

    // Validar el formulario, incluyendo el archivo de voucher
    $request->validate([
        'cantidad' => 'required|integer|min:1|max:' . $producto->stock,
        'voucher' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Limitar el tipo de archivo y tamaño
    ]);

    // Manejar la subida del archivo
    if ($request->hasFile('voucher')) {
        $voucherPath = $request->file('voucher')->store('vouchers', 'public');
    } else {
        $voucherPath = null;
    }

    $transaccion = new Transaccion();
    $transaccion->producto_id = $producto->id;
    $transaccion->user_id = $user->id;
    $transaccion->comprado = true;
    $transaccion->cantidad = $request->cantidad;
    $transaccion->voucher_path = $voucherPath; // Guardar la ruta del voucher
    $transaccion->save();

    $producto->stock -= $request->cantidad;
    $producto->save();

    // Enviar notificación al dueño del producto
    $vendedor = $producto->vendedor;
    $vendedor->notify(new ProductoComprado($producto, $user));

    return redirect()->route($user->rol . '.productos')->with('success', '¡Compra realizada con éxito!');
}


public function mostrarProductosComprados()
{
    // Obtener el usuario actual
    $usuario = Auth::user();

    // Obtener los productos comprados por el usuario actual
    $productosComprados = $usuario->productosComprados;

    // Inicializar un array para almacenar la cantidad de cada producto comprado
    $cantidadProductos = [];

    // Iterar sobre los productos comprados y calcular la cantidad total comprada de cada producto
    foreach ($productosComprados as $producto) {
        // Calcular la cantidad total comprada del producto actual
        $cantidad = Transaccion::where('producto_id', $producto->id)
            ->where('comprado', true)
            ->sum('cantidad'); // Sumamos la cantidad en lugar de contar las transacciones

        // Almacenar la cantidad total en el array utilizando el ID del producto como clave
        $cantidadProductos[$producto->id] = $cantidad;
    }

    // Obtener todas las categorías disponibles
    $categorias = Categoria::all();

    // Pasar las variables a la vista
    return view('productosComprados', compact('productosComprados', 'cantidadProductos', 'categorias'));
}

public function comprar(Producto $producto)
{
    $rol = Auth::user()->rol;
    return view('comprarProdcutos', compact('producto', 'rol'));
}

public function calificarTransaccion(Request $request, Transaccion $transaccion)
    {
        // Validar la calificación
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Asegurarse de que el usuario actual sea el comprador de la transacción
        if ($transaccion->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para calificar esta transacción.');
        }

        // Guardar la calificación
        $transaccion->rating = $request->rating;
        $transaccion->save();

        return redirect()->route('Cliente.productos.comprados')->with('success', 'Calificación guardada con éxito.');
    }

    public function agregarFoto(Request $request, Producto $producto)
{
    // Verificar que el producto no esté consignado
    if ($producto->state === 'aceptado') {
        return redirect()->back()->with('error', 'No puedes agregar fotos a un producto consignado.');
    }

    // Validar la foto
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Guardar la foto
    $ruta = $request->file('foto')->store('fotos_productos', 'public');

    // Crear la relación en la base de datos
    FotoProducto::create([
        'producto_id' => $producto->id,
        'ruta' => $ruta,
    ]);

    return redirect()->route('Vendedor.misproductos')->with('success', 'Foto agregada con éxito.');
}

// Método para eliminar una foto
public function eliminarFoto(FotoProducto $foto)
{
    $producto = $foto->producto;

    // Verificar que el producto no esté consignado
    if ($producto->state === 'aceptado') {
        return redirect()->back()->with('error', 'No puedes eliminar fotos de un producto consignado.');
    }

    // Eliminar la foto físicamente
    Storage::disk('public')->delete($foto->ruta);

    // Eliminar la relación en la base de datos
    $foto->delete();

    return redirect()->route('Vendedor.misproductos')->with('success', 'Foto eliminada con éxito.');
}



}
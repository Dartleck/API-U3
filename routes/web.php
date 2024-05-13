<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContadorController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\VendedorController;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\UsuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductoController::class, 'anonimo'])->name('anonimo');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'encargado'])->group(function () {
    Route::get('/encargado', [EncargadoController::class, 'index'])->name('Encargado.home');
     // Ruta para que el supervisor pueda ver los productos
    Route::get('/encargado/productos', [ProductoController::class, 'index'])->name('Encargado.productos');
    Route::get('/encargado/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('Encargado.productos.edit');
    
    Route::put('/encargado/productos/{producto}', [ProductoController::class, 'update'])->name('Encargado.productos.update');
    
    Route::delete('/encargado/productos/{producto}', [ProductoController::class, 'destroy'])->name('Encargado.productos.destroy');
    //Encargado usuario
    Route::post('/encargado/usuarios/{usuario}/reset-password', [EncargadoController::class, 'resetPassword'])->name('Encargado.usuarios.resetPassword'); 
    Route::get('/encargado/usuarios', [UsuariosController::class, 'index'])->name('Encargado.usuarios');
    Route::get('/encargado/usuarios/reset-password/{usuario}', [EncargadoController::class, 'showResetPasswordForm'])->name('Encargado.usuarios.resetPasswordForm');
});



Route::get('/buscar', [ProductoController::class, 'anonimo'])->name('productos');

Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('/cliente', [ClienteController::class, 'index'])->name('Cliente.home');
    // Aquí puedes definir otras rutas específicas para el rol de Cliente
    Route::get('/cliente/productos', [ProductoController::class, 'index'])->name('Cliente.productos');
    

    
    Route::post('/cliente/crearPregunta/{productoId}', [PreguntaController::class, 'crearPregunta'])->name('Cliente.preguntas.store');
    Route::get('/cliente/producto/{producto}', [PreguntaController::class, 'obtenerPreguntas'])->name('Cliente.preguntas.index');

    Route::post('/cliente/respuestas/{pregunta}', [RespuestaController::class,'store'])->name('Cliente.respuestas.store');
   
    Route::get('/cliente/productos/{producto}/comprar', [ProductoController::class, 'comprar'])->name('Cliente.productos.comprar');
    Route::post('/cliente/productos/{producto}/comprar', [ProductoController::class, 'realizarCompra'])->name('Cliente.productos.realizarCompra');
    Route::get('/cliente/productos/comprados', [ProductoController::class, 'mostrarProductosComprados'])->name('Cliente.productos.comprados');

    
});

Route::middleware(['auth', 'contador'])->group(function () {
    Route::get('/contador', [ContadorController::class, 'index'])->name('Contador.home');
    // Aquí puedes definir otras rutas específicas para el rol de Contador
});

Route::middleware(['auth', 'supervisor'])->group(function () {
    Route::get('/supervisor', [SupervisorController::class, 'index'])->name('Supervisor.home');
    // Ruta para que el supervisor pueda ver los productos
    Route::get('/supervisor/productos', [ProductoController::class, 'index'])->name('Supervisor.productos');
    // Ruta para mostrar el formulario de creación de productos
    Route::get('/supervisor/productos/crear', [ProductoController::class, 'create'])->name('Supervisor.productos.crear');
    // Ruta para manejar la creación de productos
    Route::post('/supervisor/productos', [ProductoController::class, 'store'])->name('Supervisor.productos.store');
    // Ruta para mostrar el formulario de edición de productos
    Route::get('/supervisor/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('Supervisor.productos.edit');
    // Ruta para manejar la actualización de productos
    Route::put('/supervisor/productos/{producto}', [ProductoController::class, 'update'])->name('Supervisor.productos.update');
    // Ruta para manejar la eliminación de productos
    Route::delete('/supervisor/productos/{producto}', [ProductoController::class, 'destroy'])->name('Supervisor.productos.destroy');
    //Dashboard
    Route::get('/supervisor/dashboard', [DashboardController::class, 'index'])->name('Supervisor.dashboard');
    //Nuevo usuario
    Route::get('/supervisor/usuarios/crear', [UsuariosController::class, 'create'])->name('Supervisor.usuarios.create');
    Route::get('/supervisor/usuarios', [UsuariosController::class, 'index'])->name('Supervisor.usuarios');
    Route::post('/supervisor/usuarios', [UsuariosController::class, 'store'])->name('Supervisor.usuarios.store');
    //ediar Usuario
    Route::get('/supervisor/usuarios/{usuario}/editar', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/supervisor/usuarios/{usuario}', [UsuariosController::class, 'update'])->name('usuarios.update');
    // Ruta para eliminar usuarios
    Route::delete('/supervisor/usuarios/{usuario}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    //Hisotrial vendedor
    Route::get('/supervisor/vendedores/{id}/historial', [SupervisorController::class, 'vendedorHistorial'])->name('Supervisor.vendedor.historial');
    //Kardex producto
    Route::get('/supervisor/producto/{id}/kardex', [ProductoController::class, 'kardex'])->name('producto.kardex');

    Route::post('/supervisor/usuarios/{usuario}/reset-password', [SupervisorController::class, 'resetPassword'])->name('Supervisor.usuarios.resetPassword'); 
    
    Route::get('/supervisor/usuarios/reset-password/{usuario}', [SupervisorController::class, 'showResetPasswordForm'])->name('Supervisor.usuarios.resetPasswordForm');

    
    Route::post('/supervisor/crearPregunta/{productoId}', [PreguntaController::class, 'crearPregunta'])->name('Supervisor.preguntas.store');
    Route::get('/supervisor/producto/{producto}', [PreguntaController::class, 'obtenerPreguntas'])->name('Supervisor.preguntas.index');

    Route::post('/supervisor/respuestas/{pregunta}', [RespuestaController::class,'store'])->name('Supervisor.respuestas.store');

   
});



Route::middleware(['auth', 'vendedor'])->group(function () {
    Route::get('/vendedor', [VendedorController::class, 'index'])->name('Vendedor.home');
    Route::get('/vendedor/productos', [ProductoController::class, 'index'])->name('Vendedor.productos');
    Route::get('/vendedor/misproductos', [ProductoController::class, 'misproductos'])->name('Vendedor.misproductos');

    Route::get('/vendedor/productos/crear', [ProductoController::class, 'create'])->name('Vendedor.productos.crear');
    // Ruta para manejar la creación de productos
    Route::post('/vendedor/productos', [ProductoController::class, 'store'])->name('Vendedor.productos.store');
    // Ruta para mostrar el formulario de edición de productos
    Route::get('/vendedor/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('Vendedor.productos.edit');
    // Ruta para manejar la actualización de productos
    Route::put('/vendedor/productos/{producto}', [ProductoController::class, 'update'])->name('Vendedor.productos.update');
    // Ruta para manejar la eliminación de productos
    Route::delete('/vendedor/productos/{producto}', [ProductoController::class, 'destroy'])->name('Vendedor.productos.destroy');
    //Dashboard

    Route::prefix('preguntas')->group(function () {
        Route::post('/crearPregunta/{productoId}', [PreguntaController::class, 'crearPregunta'])->name('Vendedor.preguntas.store');
        Route::get('/producto/{producto}', [PreguntaController::class, 'obtenerPreguntas'])->name('Vendedor.preguntas.index');

        Route::post('/respuestas/{pregunta}', [RespuestaController::class,'store'])->name('Vendedor.respuestas.store');

    });
    // Aquí puedes definir otras rutas específicas para el rol de Vendedor
});


//Categorias
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/agregar', [CategoriaController::class, 'create'])->name('categorias.create');
Route::resource('categorias', CategoriaController::class);



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContadorController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\VendedorController;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['auth', 'encargado'])->group(function () {
    Route::get('/encargado', [EncargadoController::class, 'index'])->name('encargado.home');
    
    // Aquí puedes definir otras rutas específicas para el rol de Encargado
});

Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.home');
    // Aquí puedes definir otras rutas específicas para el rol de Cliente
});

Route::middleware(['auth', 'contador'])->group(function () {
    Route::get('/contador', [ContadorController::class, 'index'])->name('contador.home');
    // Aquí puedes definir otras rutas específicas para el rol de Contador
});

Route::middleware(['auth', 'supervisor'])->group(function () {
    Route::get('/supervisor', [SupervisorController::class, 'index'])->name('supervisor.home');
    // Ruta para que el supervisor pueda ver los productos
    Route::get('/supervisor/productos', [ProductoController::class, 'index'])->name('supervisor.productos');
    // Ruta para mostrar el formulario de creación de productos
    Route::get('/supervisor/productos/crear', [ProductoController::class, 'create'])->name('supervisor.productos.crear');
    // Ruta para manejar la creación de productos
    Route::post('/supervisor/productos', [ProductoController::class, 'store'])->name('supervisor.productos.store');
    // Ruta para mostrar el formulario de edición de productos
    Route::get('/supervisor/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('supervisor.productos.edit');
    // Ruta para manejar la actualización de productos
    Route::put('/supervisor/productos/{producto}', [ProductoController::class, 'update'])->name('supervisor.productos.update');
    // Ruta para manejar la eliminación de productos
    Route::delete('/supervisor/productos/{producto}', [ProductoController::class, 'destroy'])->name('supervisor.productos.destroy');
});



Route::middleware(['auth', 'vendedor'])->group(function () {
    Route::get('/vendedor', [VendedorController::class, 'index'])->name('vendedor.home');
    // Aquí puedes definir otras rutas específicas para el rol de Vendedor
});


Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productos/{producto}', [ProductoController::class, 'show']);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');




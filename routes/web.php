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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

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
    // Aquí puedes definir otras rutas específicas para el rol de Supervisor
});

Route::middleware(['auth', 'vendedor'])->group(function () {
    Route::get('/vendedor', [VendedorController::class, 'index'])->name('vendedor.home');
    // Aquí puedes definir otras rutas específicas para el rol de Vendedor
});
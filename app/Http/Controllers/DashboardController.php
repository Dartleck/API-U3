<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaccion;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $rol = Auth::user()->rol;
    
        // Obtener la cantidad de usuarios registrados
        $totalUsuarios = User::count();
    
        // Obtener la cantidad total de transacciones
        $totalTransacciones = Transaccion::count();
    
        // Obtener la cantidad de productos aceptados
        $totalProductosAceptados = Producto::where('state', 'aceptado')->count();
    
        // Obtener la cantidad de productos pendientes
        $totalProductosPendientes = Producto::where('state', 'pendiente')->count();
    
        // Obtener la cantidad de productos rechazados
        $totalProductosRechazados = Producto::where('state', 'rechazado')->count();
    
        // Retorna la vista del tablero con la información recopilada
        return view('dashboard', compact('totalUsuarios', 'totalTransacciones', 'totalProductosAceptados', 'totalProductosPendientes', 'totalProductosRechazados', 'rol'));
    }
}

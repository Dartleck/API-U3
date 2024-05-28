<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaccion;
use App\Models\User;
use App\Models\Pago;

class ContadorController extends Controller
{
    public function index()
    {
        // Obtener la información del contador autenticado
        $contador = Auth::user();
        return view('contador.home', ['contador' => $contador]);
    }

    public function transacciones()
    {
        // Obtener las transacciones con sus vouchers
        $transacciones = Transaccion::with('producto', 'usuario')
            ->whereNotNull('voucher_path')
            ->get();

        return view('contador.transacciones', compact('transacciones'));
    }

    public function validarTransaccion(Transaccion $transaccion)
    {
        // Lógica para validar la transacción
        $transaccion->validado = true;
        $transaccion->save();

        return redirect()->route('Contador.transacciones')->with('success', 'Transacción validada con éxito.');
    }

    public function rechazarTransaccion(Transaccion $transaccion)
    {
        // Lógica para rechazar la transacción
        $transaccion->delete();

        return redirect()->route('Contador.transacciones')->with('success', 'Transacción rechazada con éxito.');
    }

    public function crearPago()
    {
        // Obtener usuarios que son vendedores y tienen transacciones validadas (validado = true)
        $vendedores = User::whereHas('productos.transacciones', function ($query) {
            $query->where('validado', true);
        })->get();

        return view('contador.crear_pago', compact('vendedores'));
    }

    public function storePago(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'monto' => 'required|numeric|min:0.01',
    ]);

    // Crear un nuevo pago
    $pago = new Pago();
    $pago->user_id = $request->user_id;
    $pago->monto_total = $request->monto;
    $pago->save();

    // Actualizar transacciones relacionadas
    Transaccion::where('user_id', $request->user_id)
        ->where('validado', true)
        ->update(['pagado' => true]);

    return redirect()->route('Contador.home')->with('success', 'Pago creado con éxito.');
}

public function listarPagos()
{
    // Obtener todos los pagos, ordenados por los pendientes de entregar
    $pagos = Pago::orderBy('entregado', 'asc')->get();

    return view('contador.listar_pagos', compact('pagos'));
}

public function marcarComoEntregado(Pago $pago)
    {
        // Marcar el pago como entregado
        $pago->entregado = true;
        $pago->save();

        return redirect()->route('Contador.pagos')->with('success', 'Pago marcado como entregado.');
    }
}

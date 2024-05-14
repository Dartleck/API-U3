<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producto;
class VendedorController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del vendedor
        $vendedor = Auth::user();
        return view('vendedor.home',['vendedor'=>$vendedor]);
    }

    public function productosComprados()
{
    $vendedor = Auth::user();
    $productosComprados = Producto::where('user_id', $vendedor->id)
        ->whereHas('transacciones', function ($query) {
            $query->where('comprado', true);
        })
        ->with(['transacciones' => function ($query) {
            $query->where('comprado', true);
        }])
        ->get();

    return view('vendedor.productos_comprados', compact('productosComprados'));
}


 
}

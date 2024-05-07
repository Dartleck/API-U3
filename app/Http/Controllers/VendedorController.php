<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class VendedorController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del vendedor
        $vendedor = Auth::user();
        return view('vendedor.home',['vendedor'=>$vendedor]);
    }

 
}

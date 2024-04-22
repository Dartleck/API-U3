<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del vendedor
        return view('vendedor.home');
    }
}

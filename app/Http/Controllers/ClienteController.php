<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del Encargado
        return view('cliente.home');
    }
}

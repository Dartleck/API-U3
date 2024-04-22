<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncargadoController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del Encargado
        return view('encargado.home');
    }
}

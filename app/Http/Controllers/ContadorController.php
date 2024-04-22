<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContadorController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del contador
        return view('contador.home');
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContadorController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del contador
        $contador = Auth::user();
        return view('contador.home',['contador'=>$contador]);
    }
}

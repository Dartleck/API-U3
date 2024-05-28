<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio 
        $cliente = Auth::user();
        return view('cliente.home',['cliente'=>$cliente]);
    }
}

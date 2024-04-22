<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del supervisor
        return view('supervisor.home');
    }
}

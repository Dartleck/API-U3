@extends('app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Bienvenido Encargado: {{ $encargado->name }}</h1>
        <div class="d-flex flex-column align-items-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Gestión Rápida</h5>
                    <p class="card-text">Seleccione una de las siguientes opciones para gestionar la plataforma.</p>
                    <div class="list-group">
                        <a href="{{ route('Encargado.productos') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-box-seam me-2"></i> Ver Productos
                        </a>
                        <a href="{{ route('Encargado.usuarios') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-people me-2"></i> Ver Usuarios
                        </a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection

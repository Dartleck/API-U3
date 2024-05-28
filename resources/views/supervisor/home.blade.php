@extends('layouts.app')

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
        <h1 class="mb-4 text-center">Bienvenido Supervisor: {{ $supervisor->name }}</h1>
        <div class="d-flex flex-column align-items-center">
            <div class="card shadow" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Panel de Control</h5>
                    <p class="card-text">Acceda rápidamente a las funciones comunes.</p>
                    <div class="list-group">
                        <a href="{{ route('Supervisor.productos') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-grid me-2"></i> Ver Productos
                        </a>
                        <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-tags me-2"></i> Ver Categorías
                        </a>
                        <a href="{{ route('Supervisor.productos.crear') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i> Agregar Nuevo Producto
                        </a>
                        <a href="{{ route('categorias.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-tag me-2"></i> Agregar Nueva Categoría
                        </a>
                        <a href="{{ route('Supervisor.usuarios.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-person-plus me-2"></i> Agregar Nuevo Usuario
                        </a>
                        <a href="{{ route('Supervisor.usuarios') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-people me-2"></i> Ver Usuarios
                        </a>
                        <a href="{{ route('Supervisor.dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-bar-chart me-2"></i> Dashboard Informe
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection

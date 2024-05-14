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
        <h1 class="mb-4 text-center">Bienvenido Vendedor: {{ $vendedor->name }}</h1>
        <div class="d-flex flex-column align-items-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Acciones Disponibles</h5>
                    <p class="card-text">Seleccione una opción para administrar sus productos.</p>
                    <div class="list-group">
                        <a href="{{ route('Vendedor.productos.crear') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i> Agregar Nuevo Producto
                        </a>
                        <a href="{{ route('Vendedor.productos') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-grid me-2"></i> Ver Productos
                        </a>
                        <a href="{{ route('Vendedor.misproductos') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-box2 me-2"></i> Mis Productos
                        </a>
                        <a href="{{ route('Vendedor.productos_comprados') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-bag-check me-2"></i> Productos Comprados
                        </a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection

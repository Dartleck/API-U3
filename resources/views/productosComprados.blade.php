@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Comprados</title>
    <style>
        /* Estilo para el contenedor de cada producto */
        .producto {
            border-bottom: 1px solid #ccc; /* Borde inferior */
            margin-bottom: 10px; /* Espacio entre productos */
            padding-bottom: 10px; /* Espacio interno inferior */
        }
    </style>
    
</head>
<body>

    <a href="{{ route('Cliente.home') }}" class="btn btn-secondary mt-3">Volver</a>

    <div class="container">
        <h1 class="my-4">Productos Comprados</h1>

        {{-- Verificar si hay productos comprados --}}
        @if ($productosComprados->isNotEmpty())
            {{-- Inicializar el gasto total --}}
            @php
                $totalGasto = 0;
            @endphp

            {{-- Iterar sobre los productos comprados --}}
            @foreach($productosComprados as $producto)
                {{-- Calcular el gasto total por este producto --}}
                @php
                    $gastoProducto = $cantidadProductos[$producto->id] * $producto->price;
                    $totalGasto += $gastoProducto;
                @endphp

                {{-- Mostrar detalles del producto --}}
                <div class="producto">
                    <p><strong>Nombre:</strong> {{ $producto->name }}</p>
                    <p><strong>Descripción:</strong> {{ $producto->description }}</p>
                    <p><strong>Precio:</strong> ${{ number_format($producto->price, 2, '.', ',') }}</p>
                    <p><strong>Cantidad de productos comprados:</strong> {{ $cantidadProductos[$producto->id] }}</p>
                    <p><strong>Gasto total por este producto:</strong> ${{ number_format($gastoProducto, 2, '.', ',') }}</p>
                </div>
            @endforeach

            {{-- Mostrar el gasto total acumulado --}}
            <h2>Gasto Total: ${{ number_format($totalGasto, 2, '.', ',') }}</h2>

        @else
            <p>No hay productos comprados.</p>
        @endif

    </div>
</body>
</html>
@endsection

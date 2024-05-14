<!-- resources/views/supervisor/vendedor/historial.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial del Vendedor</h1>
    <h2>{{ $vendedor->name }}</h2>
    <p>Fecha de alta: {{ $vendedor->created_at->format('d/m/Y') }}</p>
    <p>Total de transacciones: {{ $vendedor->transacciones->count() }}</p>
    <p>Total de productos en venta: {{ $vendedor->productos->count() }}</p>

    <h3>Transacciones</h3>
    <ul>
        @forelse ($transacciones as $transaccion)
            <li>
                {{ $transaccion->created_at->format('d/m/Y') }} - {{ $transaccion->producto->name ?? 'Producto no encontrado' }} - Cantidad: {{ $transaccion->cantidad }}
            </li>
        @empty
            <li>No hay transacciones.</li>
        @endforelse
    </ul>

    <h3>Productos en Venta</h3>
    <ul>
        @forelse ($productos as $producto)
            <li>{{ $producto->name }} - Precio: ${{ $producto->price }}</li>
        @empty
            <li>No hay productos en venta.</li>
        @endforelse
    </ul>
</div>
@endsection

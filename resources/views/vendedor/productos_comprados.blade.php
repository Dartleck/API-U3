<!-- resources/views/vendedor/productos_comprados.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos Comprados</h1>

    @forelse ($productosComprados as $producto)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $producto->name }}</h5>
                <p class="card-text">{{ $producto->description }}</p>
                <p class="card-text">Precio: ${{ $producto->price }}</p>
                <p class="card-text">Stock original: {{ $producto->stock }}</p>

                <h6>Transacciones</h6>
                <ul>
                    @foreach ($producto->transacciones as $transaccion)
                        <li>
                            {{ $transaccion->created_at }} - Comprado por {{ $transaccion->usuario->name }} - Cantidad: {{ $transaccion->cantidad }}
                        </li>
                    @endforeach
                </ul>

                <p class="card-text">Piezas restantes: {{ $producto->stock - $producto->transacciones->sum('cantidad') }}</p>
            </div>
        </div>
    @empty
        <p>No hay productos comprados.</p>
    @endforelse
</div>
@endsection

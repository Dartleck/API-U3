// resources/views/productos.blade.php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>

    <form id="searchForm" action="{{ route('productos') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="categoria_id">Buscar por categoría:</label>
            <select name="categoria_id" id="categoria" class="form-control" onchange="this.form.submit()">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @foreach($categorias as $categoria)
        @if(request('categoria_id') == $categoria->id || request('categoria_id') == '')
            <div id="categoria{{ $categoria->id }}" class="categoria">
                <h2>{{ $categoria->name }}</h2>
                <div class="row">
                    @foreach($categoria->productos as $producto)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->name }}</h5>
                                    <p class="card-text">{{ $producto->description }}</p>
                                    <p class="card-text">Precio: ${{ number_format($producto->price, 2, '.', ',') }}</p>
                                    <p class="card-text">Stock: {{ $producto->stock }}</p>
                                    <p class="card-text">Estado: {{ $producto->state }}</p> <!-- Mostrar el estado del producto -->

                                    <!-- Mostrar las fotos del producto -->
                                    @foreach($producto->fotos as $foto)
                                        <img src="{{ asset('storage/' . $foto->ruta) }}" alt="Foto del Producto" class="img-fluid">
                                    @endforeach

                                    <!-- Enlaces para ver y hacer preguntas -->
                                    <a href="{{ route('Cliente.preguntas.index', $producto->id) }}" class="btn btn-secondary mt-2">Ver Preguntas</a>
                                    <a href="{{ route('Cliente.preguntas.store', $producto->id) }}" class="btn btn-secondary mt-2">Hacer Pregunta</a>

                                    <!-- Enlace para comprar -->
                                    @if($producto->state == 'aceptado')
                                        <a href="{{ route('Cliente.productos.comprar', $producto->id) }}" class="btn btn-success mt-2">Comprar</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>
<a href="{{ route('home') }}" class="btn btn-secondary">Regresar al Home</a>
@endsection

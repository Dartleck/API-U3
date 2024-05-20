@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Productos</title>
</head>
<body>
    <div class="container">
        <h1>Mis Productos</h1>

        <form id="searchForm" action="{{ route('Vendedor.misproductos') }}" method="GET" class="mb-3">
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
                            @if($producto->user_id == Auth::id())
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

                                            <!-- Enlaces para agregar y eliminar fotos -->
                                            <form action="{{ route('Vendedor.foto.agregar', $producto->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foto">Agregar Foto:</label>
                                                    <input type="file" name="foto" id="foto" class="form-control-file">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Agregar Foto</button>
                                            </form>

                                            <!-- Enlaces para editar y eliminar el producto -->
                                            <a href="{{ route('Vendedor.productos.edit', $producto->id) }}" class="btn btn-warning mt-2">Editar</a>
                                            <form action="{{ route('Vendedor.productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                                            </form>

                                            <!-- Enlaces para ver y hacer preguntas -->
                                            <a href="{{ route('Vendedor.preguntas.index', $producto->id) }}" class="btn btn-secondary mt-2">Ver Preguntas</a>
                                            <a href="{{ route('Vendedor.preguntas.store', $producto->id) }}" class="btn btn-secondary mt-2">Hacer Pregunta</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary">Regresar al Home</a>

    <script>
        function togglePreguntas(id) {
            var element = document.getElementById('preguntas' + id);
            element.classList.toggle('collapse');
        }
    </script>
</body>
</html>
@endsection

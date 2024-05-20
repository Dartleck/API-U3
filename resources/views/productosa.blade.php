@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
</head>
<body>
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

                                        <!-- Enlaces para editar el producto para el supervisor -->
                                        @if(Auth::check() && Auth::user()->rol === 'Supervisor')
                                            <a href="{{ route('Supervisor.productos.edit', $producto->id) }}" class="btn btn-warning mt-2">Editar</a>
                                        @endif

                                        <!-- Enlaces para ver preguntas -->
                                        <a href="{{ route('login') }}" class="btn btn-warning">Ver Preguntas</a>

                                        <!-- Enlace para hacer una pregunta -->
                                        <a href="{{ route('login') }}" class="btn btn-secondary mt-2">Hacer una pregunta</a>

                                        <!-- Botón y sección para preguntas y respuestas -->
                                        <button class="btn btn-outline-secondary mt-2" onclick="togglePreguntas('{{ $producto->id }}')">Ver Preguntas</button>
                                        <div id="preguntas{{ $producto->id }}" class="collapse">
                                            <ul>
                                                @foreach($producto->preguntas as $pregunta)
                                                    <li>
                                                        <strong>Pregunta:</strong> {{ $pregunta->contenido }}
                                                        <ul>
                                                            @foreach($pregunta->respuestas as $respuesta)
                                                                <li><strong>Respuesta:</strong> {{ $respuesta->contenido }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
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

    <script>
        function togglePreguntas(id) {
            var element = document.getElementById('preguntas' + id);
            element.classList.toggle('collapse');
        }
    </script>
</body>
</html>
@endsection

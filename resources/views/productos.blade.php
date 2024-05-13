@extends('app')

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

        <form id="searchForm" action="{{ route($rol.'.productos') }}" method="GET" class="mb-3">
            <div class="form-group">
                <label for="categoria">Buscar por categoría:</label>
                <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        @foreach($categorias as $categoria)
        @if(request('categoria') == $categoria->id || request('categoria') == '')
        <div id="categoria{{ $categoria->id }}" class="categoria">
            <h2>{{ $categoria->name }}</h2>
            <div class="row">
                @foreach($categoria->productos as $producto)
                @if($rol === 'Supervisor' || ($rol === 'Encargado') || ($rol === 'Vendedor' && $producto->state === 'aceptado') || ($rol === 'Cliente' && $producto->state === 'aceptado') || ($rol === 'Contador' && $producto->state === 'aceptado'))
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->name }}</h5>
                                <p class="card-text">{{ $producto->description }}</p>
                                <p class="card-text">Precio: ${{ number_format($producto->price, 2, '.', ',') }}</p>
                                <p class="card-text">Stock: {{ $producto->stock }}</p>

                                <!-- Enlace para editar el producto -->
                                @can('edit', $producto)
                                    <a href="{{ route($rol.'.productos.edit', $producto->id) }}" class="btn btn-info">Editar</a>
                                @endcan

                                <!-- Enlace para comprar -->
                                @can('comprar', $producto)
                                    <a href="{{ route($rol.'.productos.comprar', $producto->id) }}" class="btn btn-success">Comprar</a>
                                @endcan

                                <!-- Formulario para eliminar el producto -->
                                @can('delete', $producto)
                                    <form action="{{ route($rol.'.productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                @endcan

                                <!-- Enlace para ver kardex -->
                                @can('viewKardex', $producto)
                                    <a href="{{ route('producto.kardex', $producto->id) }}" class="btn btn-warning">Ver Kardex</a>
                                @endcan

                                <!-- Enlace para hacer una pregunta -->
                                @can('respuesta', $producto)
                                    <a href="{{ route($rol.'.preguntas.index', $producto->id) }}" class="btn btn-secondary mt-2">Hacer una pregunta</a>
                                @endcan

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
                @endif
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <a href="{{ route($rol.'.home') }}" class="btn btn-secondary">Regresar al Home del {{ ucfirst($rol) }}</a>

    <script>
        function togglePreguntas(id) {
            var element = document.getElementById('preguntas' + id);
            element.classList.toggle('collapse');
        }
    </script>
</body>
</html>
@endsection

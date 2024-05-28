@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorías</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Categorías</h1>

        <div class="list-group">
            @foreach($categorias as $categoria)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $categoria->name }}</span>
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">Agregar Nueva Categoría</a>
        </div>

        <div class="mt-4">
            <a href="{{ route($rol.'.home') }}" class="btn btn-secondary">Regresar al Home del {{ ucfirst($rol) }}</a>
        </div>
    </div>
</body>
</html>
@endsection

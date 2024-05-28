@extends('app')

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
    <div class="container mt-4">
        <h1 class="mb-3">Lista de Usuarios</h1>
    
        @foreach($usuariosPorRol as $rol => $usuarios)
            <h2>{{ ucfirst($rol) }}</h2>
            <ul class="list-group mb-4">
                @foreach($usuarios as $usuario)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $usuario->name }} - {{ $usuario->email }}
    
                        <div class="btn-group" role="group" aria-label="User Actions">
                            <form method="GET" action="{{ route(Auth::user()->rol.'.usuarios.resetPasswordForm', $usuario->id) }}" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Resetear Contraseña</button>
                            </form>
    
                            @if ($rol === 'Vendedor')
                                <a href="{{ route('Supervisor.vendedor.historial', $usuario->id) }}" class="btn btn-info me-2">Ver historial</a>
                            @endif
    
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary me-2">Editar</a>
    
                            <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}" onsubmit="return confirm('¿Está seguro de que desea eliminar este usuario?');" class="me-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endforeach
        <a href="{{ route(Auth::user()->rol.'.home') }}" class="btn btn-link">Regresar al home del {{ ucfirst(Auth::user()->rol) }}</a>
    </div>
</body>
</html>
@endsection

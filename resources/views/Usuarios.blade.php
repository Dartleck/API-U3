<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>

    @foreach($usuariosPorRol as $rol => $usuarios)
        <h2>{{ ucfirst($rol) }}</h2>
        <ul>
            @foreach($usuarios as $usuario)
                <li>
                    {{ $usuario->name }} - {{ $usuario->email }}
                    <form method="GET" action="{{ route(Auth::user()->rol.'.usuarios.resetPasswordForm', $usuario->id) }}" style="display: inline-block;">
                        @csrf
                        <button type="submit">Resetear Contraseña</button>
                    </form>
                    
                    <!-- Agregar botón para ver historial -->
                    @if ($rol === 'Vendedor')
                        <a href="{{ route('Supervisor.vendedor.historial', $usuario->id) }}">Ver historial</a>
                    @endif
                    <!-- Fin de botón para ver historial -->
                    <a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                    <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endforeach
    <a href="{{ route(Auth::user()->rol.'.home') }}">Regresar al home del {{ ucfirst(Auth::user()->rol) }}</a>
</body>
</html>

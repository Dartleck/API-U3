<!-- editar_usuario.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>

    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $usuario->name }}" required>
        </div>

        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="{{ $usuario->email }}" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="supervisor" {{ $usuario->rol === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                <option value="encargado" {{ $usuario->rol === 'encargado' ? 'selected' : '' }}>Encargado</option>
                <option value="cliente" {{ $usuario->rol === 'cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="vendedor" {{ $usuario->rol === 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                <option value="contador" {{ $usuario->rol === 'contador' ? 'selected' : '' }}>Contador</option>
            </select>
        </div>

        <button type="submit">Actualizar Usuario</button>
    </form>
</body>
</html>

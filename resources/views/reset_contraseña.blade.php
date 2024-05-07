<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
</head>
<body>
    <h1>Restablecer Contraseña</h1>

    <form action="{{ route(Auth::user()->rol.'.usuarios.resetPassword', $usuario->id) }}" method="POST">
        @csrf
        @method('POST')
        
        <div>
            <label for="nueva_contraseña">Nueva Contraseña:</label>
            <input type="password" id="nueva_contraseña" name="nueva_contraseña" required>
        </div>

        <button type="submit">Restablecer Contraseña</button>
    </form>
</body>
</html>

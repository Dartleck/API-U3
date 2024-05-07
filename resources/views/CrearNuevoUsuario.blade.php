<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
</head>
<body>
    <h1>Crear Nuevo Usuario</h1>

    <form method="POST" action="{{ route('Supervisor.usuarios.store') }}">
        @csrf

        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="supervisor">Supervisor</option>
                <option value="encargado">Encargado</option>
                <option value="cliente">Cliente</option>
                <option value="vendedor">Vendedor</option>
                <option value="contador">Contador</option>
                <!-- Agrega más opciones de roles si es necesario -->
            </select>
        </div>

        <button type="submit">Crear Usuario</button>
    </form>
</body>
</html>

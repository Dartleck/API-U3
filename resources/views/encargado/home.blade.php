<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio del encargado</title>
</head>
<body>
    <h1>Bienvenido Encargado: {{ $encargado->name }}</h1>
    <!-- Botón para ir a la página de productos -->
    <a href="{{ route('Encargado.productos') }}">Ver Productos</a>
    <br>
    <br>
    <a href="{{ route('Encargado.usuarios') }}">Ver Usuarios</a>
    <br>
    <br>
    <a href="{{ route('login') }}">Logout</a>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio del cliente</title>
</head>
<body>
    <h1>Bienvenido Cliente: {{ $cliente->name }}</h1>
    <a href="{{ route('Cliente.productos') }}">Ver Productos</a>
    <br>
    <br>
    <a href="{{ route('login') }}">Logout</a>
</body>
</html>

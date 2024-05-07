<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio del vendedor</title>
</head>
<body>
    <h1>Bienvenido Vendedor: {{ $vendedor->name }}</h1>
    <!-- Contenido específico para el Encargado -->
    <br>
    <a href="{{ route('Vendedor.productos.crear') }}">Agregar Nuevo Producto</a>
    <br>
    <a href="{{ route('Vendedor.productos') }}">Ver Productos</a>
    <br>
    <a href="{{ route('Vendedor.misproductos') }}">Mis productos</a>
    <br>
    <br>
    <a href="{{ route('login') }}">Logout</a>
    
</body>
</html>

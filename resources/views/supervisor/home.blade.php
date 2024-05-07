<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio del supervisor</title>
</head>
<body>
    <h1>Bienvenido Supervisor: {{ $supervisor->name }}</h1>
    <!-- Botón para ir a la página de productos -->
    <a href="{{ route('Supervisor.productos') }}">Ver Productos</a>
    <br>
    <br>
    <a href="{{ route('categorias.index') }}">Ver Categorias</a>
    <br>
    <br>
    <a href="{{ route('Supervisor.productos.crear') }}">Agregar Nuevo Producto</a>
    <br>
    <br>
    <a href="{{ route('categorias.create') }}">Agregar Nueva Categoria</a>
    <br>
    <br>
    <a href="{{ route('Supervisor.usuarios.create') }}">Agregar Nuevo Usuario</a>
    <br>
    <br>
    <a href="{{ route('Supervisor.usuarios') }}">Ver usuarios</a>
    <br>
    <br>
    <a href="{{ route('Supervisor.dashboard') }}">Dashboard Informe</a>
    <br>
    <br>
    <a href="{{ route('login') }}">Logout</a>
</body>
</html>

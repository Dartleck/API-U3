<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial del Vendedor</title>
</head>
<body>
    <h1>Historial del Vendedor: {{ $vendedor->name }}</h1>

    <p><strong>Fecha de Alta:</strong> {{ $vendedor->fechaAlta() }}</p>
    <p><strong>Transacciones Realizadas:</strong> {{ $vendedor->totalTransacciones() }}</p>
    <p><strong>Productos en Venta:</strong> {{ $vendedor->totalProductos() }}</p>
    
    <a href="{{ route('Supervisor.usuarios') }}">Regresar a la lista de Usuarios</a>
</body>
</html>

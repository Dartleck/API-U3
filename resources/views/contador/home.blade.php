<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio del Contador</title>
    <!-- Incluye los estilos de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido Contador: {{ $contador->name }}</h1>
        <!-- Botón para redirigir a la vista de validación de transacciones -->
        <a href="{{ route('Contador.transacciones') }}" class="btn btn-primary mt-3">Validar Transacciones</a>
        <!-- Botón para redirigir a la vista de creación de pagos -->
        <a href="{{ route('Contador.pago.crear') }}" class="btn btn-secondary mt-3">Crear Nuevo Pago</a>
        <!-- Botón para redirigir a la vista de listar pagos -->
        <a href="{{ route('Contador.pagos') }}" class="btn btn-info mt-3">Listar Pagos</a>
    </div>
</body>
</html>

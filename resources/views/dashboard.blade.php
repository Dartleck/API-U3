<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero</title>
</head>
<body>
    <h1>Informes</h1>

    <div>
        <h2>Usuarios Registrados</h2>
        <p>Total: {{ $totalUsuarios }}</p>
    </div>

    <div>
        <h2>Transacciones</h2>
        <p>Total: {{ $totalTransacciones }}</p>
    </div>

    <div>
        <h2>Productos Aceptados</h2>
        <p>Total: {{ $totalProductosAceptados }}</p>
    </div>

    <div>
        <h2>Productos Pendientes</h2>
        <p>Total: {{ $totalProductosPendientes }}</p>
    </div>

    <div>
        <h2>Productos Rechazados</h2>
        <p>Total: {{ $totalProductosRechazados }}</p>
    </div>

    <br>
    <br>
    <a href="{{ route($rol.'.home') }}">Regresar al Home del {{ ucfirst($rol) }}</a>
</body>
</html>

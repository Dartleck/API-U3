<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex del Producto: {{ $producto->nombre }}</title>
</head>
<body>
    <h1>Kardex del Producto: {{ $producto->nombre }}</h1>

    <h2>Transacciones</h2>
    <ul>
        @foreach($transacciones as $transaccion)
            <li>
                <strong>Fecha:</strong> {{ $transaccion->created_at }}<br>
                @if($transaccion->publicado)
                    <span style="color: blue;">Publicación del Producto</span><br>
                @elseif($transaccion->interesado)
                    <span style="color: orange;">Interés Mostrado</span><br>
                @elseif($transaccion->comprado)
                    <span style="color: green;">Compra del Producto</span><br>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>

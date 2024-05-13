<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar Producto</title>
</head>
<body>
    <h1>Comprar Producto</h1>

    <form action="{{ route($rol.'.productos.realizarCompra', $producto->id) }}" method="POST">
        @csrf
        <p><strong>Nombre:</strong> {{ $producto->name }}</p>
        <p><strong>Descripción:</strong> {{ $producto->description }}</p>
        <p><strong>Precio:</strong> ${{ number_format($producto->price, 2, '.', ',') }}</p>
        <p><strong>Stock Disponible:</strong> {{ $producto->stock }}</p>
        <p><strong>Cantidad a Comprar:</strong> <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}"></p>
        <p><strong>Vendedor:</strong> {{ $producto->user->name}}</p>
        <button type="submit">Comprar</button>
    </form>
    

    <a href="{{ route($rol.'.productos') }}">Volver a la lista de productos</a>
</body>
</html>

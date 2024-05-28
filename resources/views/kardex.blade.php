<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex del Producto: {{ $producto->name }}</title>
    <style>
        .blue { color: blue; }
        .orange { color: orange; }
        .green { color: green; }
    </style>
</head>
<body>
    <h1>Kardex del Producto: {{ $producto->name }}</h1>

    <h2>Transacciones</h2>
    <ul>
       
            <li>
                <strong>Fecha:</strong> {{ $producto->created_at }}<br>  
             
                    <span class="orange">Interés Mostrado</span> - Preguntas realizadas: {{ $numPreguntas }}<br>
               
                    <span class="green">Compras del Producto</span> - Personas que lo han comprado: {{ $numCompras }}<br>
            </li>
    
    </ul>
</body>
</html>
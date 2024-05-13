<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Categoría</title>
</head>
<body>
    <h1>Agregar Nueva Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre de la categoría:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <button type="submit">Agregar Categoría</button>
    </form>
</body>
</html>

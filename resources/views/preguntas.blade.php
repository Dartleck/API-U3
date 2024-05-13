<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Pregunta</title>
</head>
<body>
    <h1>Enviar Pregunta</h1>

    <form action="{{ route($rol.'.preguntas.store', $producto->id) }}" method="POST">
        
        @csrf

        <label for="contenido">Haz una pregunta sobre este producto:</label><br>
        <textarea id="contenido" name="contenido" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Enviar Pregunta</button>
    </form>
</body>
</html>

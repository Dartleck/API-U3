<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Producto</title>
</head>
<body>
    <h1>Crear Nuevo Producto</h1>

    <form action="{{ route($rol . '.productos.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required><br><br>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br><br>

        <label for="confirmado">Estado:</label>
        <select id="confirmado" name="state" required>
        <option value="pendiente" @if($producto->state == 'pendiente') selected @endif>Pendiente</option>
        </select><br><br>
        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>
            <!-- Iterar sobre las categorías disponibles -->
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Guardar Producto</button>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
    </form>
</body>
</html>

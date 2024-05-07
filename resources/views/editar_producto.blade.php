<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>

    <form action="{{ route($rol . '.productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos para editar el producto -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ $producto->name }}" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required>{{ $producto->description }}</textarea><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="{{ $producto->price }}" step="0.01" required><br><br>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="{{ $producto->stock }}" required><br><br>

        <label for="confirmado">Estado:</label>
        <select id="confirmado" name="state" required onchange="toggleRazon()">

            <option value="aceptado" @if($producto->state == 'aceptado') selected @endif>Aceptado</option>
            <option value="pendiente" @if($producto->state == 'pendiente') selected @endif>Pendiente</option>
            <option value="rechazado" @if($producto->state == 'rechazado') selected @endif>Rechazado</option>
        </select><br><br>
        
        <label for="razon_rechazo" id="razon_rechazo_label" style="display: none;">Razón de rechazo:</label>
        <textarea id="razon_rechazo" name="razon_rechazo" rows="4" cols="50" style="display: none;"></textarea><br><br>
        
        <script>
            function toggleRazon() {
                var state = document.getElementById('confirmado').value;
                var razonRechazoLabel = document.getElementById('razon_rechazo_label');
                var razonRechazoTextarea = document.getElementById('razon_rechazo');
        
                if (state === 'rechazado') {
                    razonRechazoLabel.style.display = 'block';
                    razonRechazoTextarea.style.display = 'block';
                } else {
                    razonRechazoLabel.style.display = 'none';
                    razonRechazoTextarea.style.display = 'none';
                }
            }
        </script>
        


        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>
            <!-- Iterar sobre las categorías disponibles -->
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" @if($producto->category_id == $categoria->id) selected @endif>{{ $categoria->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>

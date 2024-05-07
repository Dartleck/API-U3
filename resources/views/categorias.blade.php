<!-- index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorías</title>
</head>
<body>
    <h1>Lista de Categorías</h1>

    <ul>
        @foreach($categorias as $categoria)
            <li>
                {{ $categoria->name }}
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
    <br>
    <br>
    <a href="{{ route('categorias.create') }}">Agregar Nueva Categoria</a>
    <br>
    <br>
    <a href="{{ route($rol.'.home') }}">Regresar al Home del {{ ucfirst($rol) }}</a>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mis Productos</title>
</head>
<body>
    <h1>Lista de Mis Productos</h1>

    <form id="searchForm" action="{{ route($rol.'.misproductos') }}" method="GET">
        <label for="categoria">Buscar por categoría:</label>
        <select name="categoria" id="categoria">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
            @endforeach
        </select>
        <button type="submit">Buscar</button>
    </form>

    @foreach($categorias as $categoria)
    <div id="categoria{{ $categoria->id }}" class="categoria">
        <h2>{{ $categoria->name }}</h2>
        <ul>
            @foreach($categoria->productos as $producto)
            
            @if($producto->user_id == Auth::id())
            <strong>Nombre:</strong> {{ ($producto->user_id) }}<br>
            
                <li>
                    <strong>Nombre:</strong> {{ $producto->name }}<br>
            <strong>Descripción:</strong> {{ $producto->description }}<br>
            <strong>Precio:</strong> ${{ number_format($producto->price, 2, '.', ',') }}<br>
            <strong>Stock:</strong> {{ $producto->stock }}<br>
            
            <strong>Estado:</strong> {{ ucfirst($producto->state) }}<br>
            @if($producto->state === 'rechazado')
                <strong>Razón de rechazo:</strong> {{ $producto->razon_rechazo }}<br>
            @endif
            
            

            <!-- Enlace para editar el producto -->
            @can('editvend', $producto)
                <a href="{{ route($rol.'.productos.edit', $producto->id) }}">Editar</a>
            
                @if (session('error' . $producto->id))
                    <div class="alert alert-danger">
                        {{ session('error' . $producto->id) }}
                    </div>
                @endif
            @endcan
            
            <!-- Formulario para eliminar el producto -->
            @can('deletevend', $producto)
                <form action="{{ route($rol.'.productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    @endcan
                    
                    <!-- Enlace para ver kardex -->
                    @can('viewKardex', $producto)
                        <a href="{{ route('producto.kardex', $producto->id) }}">Ver Kardex</a>
                    @endcan
                    
                    
    
    
                    <!-- Acordeón para mostrar preguntas y respuestas -->
                    <div class="preguntas">
                        <button class="accordion">Preguntas y Respuestas</button>
                        <div class="panel">
                            @if(isset($preguntasPorProducto[$producto->id]) && $preguntasPorProducto[$producto->id]->count() > 0)
                                <ul>
                                    @foreach($preguntasPorProducto[$producto->id] as $pregunta)
                                        <li>
                                            <strong>Pregunta:</strong> {{ $pregunta->contenido }}
                                            
                                            <!-- Formulario para responder la pregunta -->
                                    <form action="{{ route($rol.'.respuestas.store', $pregunta->id) }}" method="POST">
                                        @csrf
                                        <textarea name="contenido" rows="3" cols="50" required></textarea><br>
                                        <button type="submit">Responder</button>
                                    </form>
                                            <ul>
                                                @if($pregunta->respuestas !== null && $pregunta->respuestas->count() > 0)
                                                    @foreach($pregunta->respuestas as $respuesta)
                                                        <li>
                                                            <strong>Respuesta:</strong> {{ $respuesta->contenido }}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li>No hay respuestas para esta pregunta.</li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No hay preguntas para este producto.</p>
                            @endif
                        </div>
                    </div>
    
                </li>
                @endif
            @endforeach
        </ul>
    </div>
    
    @endforeach
    

    <a href="{{ route($rol.'.home') }}">Regresar al Home del {{ ucfirst($rol) }}</a>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe automáticamente

            // Obtener el valor seleccionado en el formulario de búsqueda
            var categoriaId = document.getElementById('categoria').value;

            // Mostrar u ocultar las categorías según la opción seleccionada
            var categorias = document.getElementsByClassName('categoria');
            for (var i = 0; i < categorias.length; i++) {
                if (categoriaId === '') {
                    categorias[i].style.display = 'block'; // Mostrar todas las categorías si se selecciona la opción Todas las categorías
                } else {
                    if (categorias[i].id === 'categoria' + categoriaId) {
                        categorias[i].style.display = 'block'; // Mostrar la categoría seleccionada
                    } else {
                        categorias[i].style.display = 'none'; // Ocultar las demás categorías
                    }
                }
            }
        });
    </script>
     <script>
        // Función para manejar el acordeón
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>
</body>
</html>

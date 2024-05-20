<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Pago</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Crear Nuevo Pago</h1>
        <form action="{{ route('Contador.pago.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Vendedor:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($vendedores as $vendedor)
                        <option value="{{ $vendedor->id }}">{{ $vendedor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="monto">Monto Total:</label>
                <input type="number" name="monto" id="monto" class="form-control" step="0.01" min="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Pago</button>
        </form>
        <a href="{{ route('Contador.home') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>
</html>

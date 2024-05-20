<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Transacciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Validar Transacciones</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($transacciones->isEmpty())
            <p>No hay transacciones pendientes de validación.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Usuario</th>
                        <th>Voucher</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transacciones as $transaccion)
                        <tr>
                            <td>{{ $transaccion->id }}</td>
                            <td>{{ $transaccion->producto->name }}</td>
                            <td>{{ $transaccion->usuario->name }}</td>
                            <td><a href="{{ asset('storage/' . $transaccion->voucher_path) }}" target="_blank">Ver Voucher</a></td>
                            <td>
                                <form action="{{ route('Contador.transacciones.validar', $transaccion->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Validar</button>
                                </form>
                                <form action="{{ route('Contador.transacciones.rechazar', $transaccion->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Rechazar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        <a href="{{ route('Contador.home') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>
</html>

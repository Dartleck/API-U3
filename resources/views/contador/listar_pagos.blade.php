@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pagos</title>
</head>
<body>
    <div class="container">
        <h1>Lista de Pagos</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendedor</th>
                    <th>Monto Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->usuario->name }}</td>
                        <td>${{ number_format($pago->monto_total, 2, '.', ',') }}</td>
                        <td>{{ $pago->entregado ? 'Entregado' : 'Pendiente' }}</td>
                        <td>
                            @if(!$pago->entregado)
                                <form action="{{ route('Contador.pago.entregar', $pago) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Marcar como Entregado</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('Contador.home') }}" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Crear Nuevo Usuario</h1>

    <form method="POST" action="{{ route('Supervisor.usuarios.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" id="rol" class="form-control">
                <option value="supervisor">Supervisor</option>
                <option value="encargado">Encargado</option>
                <option value="cliente">Cliente</option>
                <option value="vendedor">Vendedor</option>
                <option value="contador">Contador</option>
                <!-- Agrega más opciones de roles si es necesario -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Usuario</button>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection

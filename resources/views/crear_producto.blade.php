@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Crear Nuevo Producto</h1>

    <form action="{{ route($rol . '.productos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="state">Estado:</label>
            <select id="state" name="state" class="form-control" required>
                <option value="pendiente" @if(old('state') == 'pendiente') selected @endif>Pendiente</option>
            </select>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría:</label>
            <select id="categoria_id" name="categoria_id" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Producto</button>

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

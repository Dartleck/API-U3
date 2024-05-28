@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Agregar Nueva Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre de la categoría:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Agregar Categoría</button>
    </form>

 
</div>
@endsection

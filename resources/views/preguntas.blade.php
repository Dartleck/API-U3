@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Enviar Pregunta</h3>
        </div>
        <div class="card-body">
            <form action="{{ route($rol.'.preguntas.store', $producto->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="contenido">Haz una pregunta sobre este producto:</label>
                    <textarea id="contenido" name="contenido" rows="4" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Pregunta</button>
            </form>
        </div>
    </div>
</div>
@endsection

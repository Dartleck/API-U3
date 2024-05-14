@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Informes</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title">Usuarios Registrados</h2>
            <p class="card-text">Total: {{ $totalUsuarios }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title">Transacciones</h2>
            <p class="card-text">Total: {{ $totalTransacciones }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title">Productos no Consignados</h2>
            <p class="card-text">Total: {{ $totalProductosNoConsignados }}</p>
        </div>
    </div>

    <a href="{{ route($rol.'.home') }}" class="btn btn-secondary mt-4">Regresar al Home del {{ ucfirst($rol) }}</a>
</div>
@endsection

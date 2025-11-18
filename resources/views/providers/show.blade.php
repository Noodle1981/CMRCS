@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Detalle de Proveedor</h2>
    <table class="table table-bordered">
        <tr><th>Nombre</th><td>{{ $provider->name }}</td></tr>
        <tr><th>Website</th><td>{{ $provider->website_url }}</td></tr>
        <tr><th>Tipo</th><td>{{ $provider->provider_type }}</td></tr>
        <tr><th>Industria</th><td>{{ $provider->industry }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $provider->phone }}</td></tr>
        <tr><th>Dirección</th><td>{{ $provider->address }}</td></tr>
        <tr><th>Ciudad</th><td>{{ $provider->city }}</td></tr>
        <tr><th>Estado</th><td>{{ $provider->state }}</td></tr>
        <tr><th>País</th><td>{{ $provider->country }}</td></tr>
        <tr><th>Asignado a</th><td>{{ $provider->assignedTo ? $provider->assignedTo->name : 'Sin asignar' }}</td></tr>
    </table>
    <a href="#" class="btn btn-primary">Editar</a>
</div>
@endsection
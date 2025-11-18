@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Detalle de Compañía</h2>
    <table class="table table-bordered">
        <tr><th>Nombre</th><td>{{ $company->name }}</td></tr>
        <tr><th>Website</th><td>{{ $company->website_url }}</td></tr>
        <tr><th>Industria</th><td>{{ $company->industry }}</td></tr>
        <tr><th>Empleados</th><td>{{ $company->employee_count }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $company->phone }}</td></tr>
        <tr><th>Dirección</th><td>{{ $company->address }}</td></tr>
        <tr><th>Ciudad</th><td>{{ $company->city }}</td></tr>
        <tr><th>Estado</th><td>{{ $company->state }}</td></tr>
        <tr><th>País</th><td>{{ $company->country }}</td></tr>
        <tr><th>Asignado a</th><td>{{ $company->assignedTo ? $company->assignedTo->name : 'Sin asignar' }}</td></tr>
    </table>
    <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-primary">Editar</a>
</div>
@endsection
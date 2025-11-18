@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('prospects.my') }}" class="btn btn-info w-100 mb-3">Mis Prospectos</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('prospects.unassigned') }}" class="btn btn-warning w-100 mb-3">Prospectos sin asignar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('uploads.create') }}" class="btn btn-secondary w-100 mb-3">Cargar Prospectos por CSV</a>
        </div>
    </div>
    <div class="mb-4">
        <a href="{{ route('prospects.companies') }}" class="btn btn-primary">Compañías asignadas</a>
        <a href="{{ route('prospects.providers') }}" class="btn btn-success">Proveedores asignados</a>
        <a href="{{ route('services.index') }}" class="btn btn-info">Servicios disponibles</a>
        <a href="{{ route('providers.match') }}" class="btn btn-warning">Buscar proveedores por servicio</a>
        <a href="{{ route('service_categories.index') }}" class="btn btn-secondary">Categorías de servicios</a>
    </div>
</div>
@endsection

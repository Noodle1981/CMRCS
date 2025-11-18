@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Mis Prospectos</h2>
    <div class="mb-4">
        <a href="{{ route('prospects.companies') }}" class="btn btn-primary">Compañías asignadas</a>
        <a href="{{ route('prospects.providers') }}" class="btn btn-success">Proveedores asignados</a>
        <a href="{{ route('services.index') }}" class="btn btn-info">Servicios disponibles</a>
    </div>
    {{-- Aquí puedes mostrar un resumen o mensaje --}}
</div>
@endsection

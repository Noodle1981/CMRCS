@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Catálogo de Servicios</h2>
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar servicio..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de servicio</th>
                <th>Cantidad de proveedores</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->tipo_servicio }}</td>
                    <td>{{ $service->providers->count() }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No hay servicios registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
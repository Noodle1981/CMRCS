@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Buscar proveedores por servicio y ubicación</h2>
    <form method="GET" action="{{ route('providers.match') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="service">Servicio requerido</label>
                <select name="service_id" id="service" class="form-control">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>{{ $service->tipo_servicio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="state">Estado</label>
                <input type="text" name="state" id="state" class="form-control" value="{{ request('state') }}" placeholder="Ej: San Juan">
            </div>
            <div class="col-md-3">
                <label for="city">Ciudad</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ request('city') }}" placeholder="Ej: Capital">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>
    @if(isset($providers))
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Empresa</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Ciudad</th>
                <th>Servicios</th>
            </tr>
        </thead>
        <tbody>
            @forelse($providers as $provider)
                <tr>
                    <td>{{ $provider->first_name }} {{ $provider->last_name }}</td>
                    <td>{{ $provider->company_name }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>{{ $provider->state }}</td>
                    <td>{{ $provider->city }}</td>
                    <td>
                        @foreach($provider->services as $service)
                            <span class="badge bg-info">{{ $service->tipo_servicio }}</span>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No se encontraron proveedores.</td></tr>
            @endforelse
        </tbody>
    </table>
    @endif
</div>
@endsection

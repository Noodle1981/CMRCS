@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Mis Prospectos</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Compañías asignadas</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>
                                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info btn-sm">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No tienes compañías asignadas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h4>Proveedores asignados</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($providers as $provider)
                        <tr>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>
                                <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-info btn-sm">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No tienes proveedores asignados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Categorías de servicios</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de categoría</th>
                <th>Servicios asociados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->nombre }}</td>
                    <td>
                        @foreach($category->services as $service)
                            <span class="badge bg-info">{{ $service->tipo_servicio }}</span>
                        @endforeach
                        <a href="{{ route('service_categories.edit', $category->id) }}" class="btn btn-primary btn-sm ms-2">Editar</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No hay categorías registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

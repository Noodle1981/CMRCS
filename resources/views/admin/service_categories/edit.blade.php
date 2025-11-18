@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Editar categoría: {{ $category->nombre }}</h2>
    <form method="POST" action="{{ route('service_categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la categoría</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $category->nombre }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Servicios asociados</label>
            <div class="row">
                @foreach($allServices as $service)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" id="service{{ $service->id }}"
                                {{ $service->service_category_id == $category->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="service{{ $service->id }}">
                                {{ $service->tipo_servicio }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="{{ route('service_categories.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection

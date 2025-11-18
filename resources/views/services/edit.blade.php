@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Editar Servicio</h2>
    <form method="POST" action="{{ route('admin.services.update', $service->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description">{{ $service->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Activo</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1" {{ $service->is_active ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$service->is_active ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar cambios</button>
    </form>
</div>
@endsection
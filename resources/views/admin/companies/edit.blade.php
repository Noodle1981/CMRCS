@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Editar Compañía</h2>
    <form method="POST" action="{{ route('admin.companies.update', $company->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
        </div>
        <div class="mb-3">
            <label for="website_url" class="form-label">Website</label>
            <input type="text" class="form-control" id="website_url" name="website_url" value="{{ $company->website_url }}">
        </div>
        <div class="mb-3">
            <label for="industry" class="form-label">Industria</label>
            <input type="text" class="form-control" id="industry" name="industry" value="{{ $company->industry }}">
        </div>
        <div class="mb-3">
            <label for="employee_count" class="form-label">Empleados</label>
            <input type="number" class="form-control" id="employee_count" name="employee_count" value="{{ $company->employee_count }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $company->phone }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $company->address }}">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $company->city }}">
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">Estado</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ $company->state }}">
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ $company->country }}">
        </div>
        <button type="submit" class="btn btn-success">Guardar cambios</button>
    </form>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.prospects.my') }}" class="btn btn-info w-100 mb-3">Mis Prospectos</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.prospects.unassigned') }}" class="btn btn-warning w-100 mb-3">Prospectos sin asignar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.uploads.create') }}" class="btn btn-secondary w-100 mb-3">Cargar Prospectos por CSV</a>
        </div>
    </div>
</div>
@endsection
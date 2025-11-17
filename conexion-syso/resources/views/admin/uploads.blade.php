@extends('layouts.admin')
@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Cargar Proveedores por CSV</h2>
    <form method="POST" action="{{ route('uploads.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="csv_file" class="form-label">Archivo CSV</label>
            <input type="file" class="form-control" id="csv_file" name="csv_file" required>
        </div>
        <input type="hidden" name="type" value="providers">
        <button type="submit" class="btn btn-primary">Subir y procesar</button>
    </form>
</div>
@endsection
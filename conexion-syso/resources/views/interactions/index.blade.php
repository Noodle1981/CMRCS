@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Interacciones</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Notas</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interactions as $interaction)
                <tr>
                    <td>{{ $interaction->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $interaction->type }}</td>
                    <td>{{ $interaction->notes }}</td>
                    <td>{{ $interaction->user->name }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="#" class="btn btn-success">Nueva Interacción</a>
</div>
@endsection
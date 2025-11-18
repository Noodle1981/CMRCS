@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Prospectos sin asignar</h2>
    <form method="POST" action="{{ route('prospects.assign') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h4>Compañías</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Industria</th>
                            <th>Ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td><input type="checkbox" name="company_ids[]" value="{{ $company->id }}"></td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->industry }}</td>
                                <td>{{ $company->city }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h4>Proveedores</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Industria</th>
                            <th>Ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($providers as $provider)
                            <tr>
                                <td><input type="checkbox" name="provider_ids[]" value="{{ $provider->id }}"></td>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->industry }}</td>
                                <td>{{ $provider->city }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-3">
            <label for="agent_id" class="form-label">Asignar a agente</label>
            <select name="agent_id" id="agent_id" class="form-control" required>
                <option value="">Selecciona un agente</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Asignar seleccionados</button>
    </form>
</div>
@endsection
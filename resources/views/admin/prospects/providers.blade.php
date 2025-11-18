@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Proveedores asignados</h2>
    <a href="{{ route('uploads.create') }}?type=providers" class="btn btn-success mb-3">Cargar Proveedores por CSV</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Title</th>
                <th>Company Name</th>
                <th>Company Name for Emails</th>
                <th>Email</th>
                <th>Email Status</th>
                <th>Departments</th>
                <th>Contact Owner</th>
                <th>Corporate Phone</th>
                <th># Employees</th>
                <th>Industry</th>
                <th>Keywords</th>
                <th>Person Linkedin Url</th>
                <th>Website</th>
                <th>Company Linkedin Url</th>
                <th>Facebook Url</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Company Address</th>
                <th>Company City</th>
                <th>Company State</th>
                <th>Company Country</th>
                <th>Company Phone</th>
                <th>Technologies</th>
                <th>Annual Revenue</th>
            </tr>
        </thead>
        <tbody>
            @forelse($providers as $provider)
                <tr>
                    <td>{{ $provider->first_name }}</td>
                    <td>{{ $provider->last_name }}</td>
                    <td>{{ $provider->title }}</td>
                    <td>{{ $provider->company_name }}</td>
                    <td>{{ $provider->company_name_for_emails }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>{{ $provider->email_status }}</td>
                    <td>{{ $provider->departments }}</td>
                    <td>{{ $provider->contact_owner }}</td>
                    <td>{{ $provider->corporate_phone }}</td>
                    <td>{{ $provider->employee_count }}</td>
                    <td>{{ $provider->industry }}</td>
                    <td>
                        @if(strlen($provider->keywords) > 60)
                            <span title="{{ $provider->keywords }}">{{ substr($provider->keywords, 0, 60) }}&hellip;</span>
                        @else
                            {{ $provider->keywords }}
                        @endif
                    </td>
                    <td>{{ $provider->person_linkedin_url }}</td>
                    <td>{{ $provider->website }}</td>
                    <td>{{ $provider->company_linkedin_url }}</td>
                    <td>{{ $provider->facebook_url }}</td>
                    <td>{{ $provider->city }}</td>
                    <td>{{ $provider->state }}</td>
                    <td>{{ $provider->country }}</td>
                    <td>{{ $provider->company_address }}</td>
                    <td>{{ $provider->company_city }}</td>
                    <td>{{ $provider->company_state }}</td>
                    <td>{{ $provider->company_country }}</td>
                    <td>{{ $provider->company_phone }}</td>
                    <td>{{ $provider->technologies }}</td>
                    <td>{{ $provider->annual_revenue }}</td>
                </tr>
            @empty
                <tr><td colspan="27">No hay proveedores asignados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

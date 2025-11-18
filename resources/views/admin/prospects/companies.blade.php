@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Compañías asignadas</h2>
    <a href="{{ route('uploads.create') }}?type=companies" class="btn btn-success mb-3">Cargar Compañías por CSV</a>
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
            @forelse($companies as $company)
                <tr>
                    <td>{{ $company->first_name }}</td>
                    <td>{{ $company->last_name }}</td>
                    <td>{{ $company->title }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->company_name_for_emails }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->email_status }}</td>
                    <td>{{ $company->departments }}</td>
                    <td>{{ $company->contact_owner }}</td>
                    <td>{{ $company->corporate_phone }}</td>
                    <td>{{ $company->employee_count }}</td>
                    <td>{{ $company->industry }}</td>
                    <td>
                        @if(strlen($company->keywords) > 60)
                            <span title="{{ $company->keywords }}">{{ substr($company->keywords, 0, 60) }}&hellip;</span>
                        @else
                            {{ $company->keywords }}
                        @endif
                    </td>
                    <td>{{ $company->person_linkedin_url }}</td>
                    <td>{{ $company->website }}</td>
                    <td>{{ $company->company_linkedin_url }}</td>
                    <td>{{ $company->facebook_url }}</td>
                    <td>{{ $company->city }}</td>
                    <td>{{ $company->state }}</td>
                    <td>{{ $company->country }}</td>
                    <td>{{ $company->company_address }}</td>
                    <td>{{ $company->company_city }}</td>
                    <td>{{ $company->company_state }}</td>
                    <td>{{ $company->company_country }}</td>
                    <td>{{ $company->company_phone }}</td>
                    <td>{{ $company->technologies }}</td>
                    <td>{{ $company->annual_revenue }}</td>
                </tr>
            @empty
                <tr><td colspan="27">No hay compañías asignadas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

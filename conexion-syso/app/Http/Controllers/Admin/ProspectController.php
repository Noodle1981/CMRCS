<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
{
    // Prospectos sin asignar
    public function unassigned()
    {
        $companies = Company::whereNull('assigned_to_user_id')->get();
        $providers = Provider::whereNull('assigned_to_user_id')->get();
        $agents = User::role('sales-agent')->get();
        return view('admin.prospects.unassigned', compact('companies', 'providers', 'agents'));
    }

    // Asignar prospectos a un agente
    public function assign(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:users,id',
            'company_ids' => 'array',
            'provider_ids' => 'array',
        ]);
        if ($request->has('company_ids')) {
            Company::whereIn('id', $request->company_ids)->update(['assigned_to_user_id' => $request->agent_id]);
        }
        if ($request->has('provider_ids')) {
            Provider::whereIn('id', $request->provider_ids)->update(['assigned_to_user_id' => $request->agent_id]);
        }
        return redirect()->back()->with('success', 'Prospectos asignados correctamente.');
    }

    // Prospectos asignados al usuario actual
    public function myProspects()
    {
        $companies = Company::all();
        $providers = Provider::all();
        return view('admin.prospects.my', compact('companies', 'providers'));
    }

    public function assignedCompanies()
    {
        $companies = Company::all();
        return view('admin.prospects.companies', compact('companies'));
    }

    public function assignedProviders()
    {
        $providers = Provider::all();
        return view('admin.prospects.providers', compact('providers'));
    }
}

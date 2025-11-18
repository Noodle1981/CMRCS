<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Provider;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::withCount('providers');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('tipo_servicio', 'like', "%{$search}%");
        }
        $services = $query->orderByDesc('providers_count')->orderBy('tipo_servicio')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Match providers to services based on request criteria.
     */
    public function match(Request $request)
    {
        $services = Service::orderBy('tipo_servicio')->get();
        $providers = collect();
        if ($request->filled('service_id')) {
            $query = Provider::whereHas('services', function($q) use ($request) {
                $q->where('services.id', $request->service_id);
            });
            if ($request->filled('state')) {
                $query->orderByRaw('state = ? DESC', [$request->state]);
                $query->where('state', $request->state);
            }
            if ($request->filled('city')) {
                $query->orderByRaw('city = ? DESC', [$request->city]);
                $query->where('city', $request->city);
            }
            $providers = $query->with('services')->get();
        }
        return view('providers.match', compact('services', 'providers'));
    }
}

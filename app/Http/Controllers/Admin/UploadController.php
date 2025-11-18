<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ProcessCsvUpload;

class UploadController extends Controller
{
    // Muestra el formulario de carga
    public function create(Request $request)
    {
        $type = $request->query('type');
        if ($type === 'companies') {
            return view('admin.companies_uploads');
        } elseif ($type === 'providers') {
            return view('admin.uploads');
        }
        // Si no hay tipo, redirige a mis-prospectos
        return redirect()->route('prospects.my');
    }

    // Procesa el archivo CSV subido
    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            'type' => 'required|in:companies,providers',
        ]);

        $path = $request->file('csv_file')->store('uploads');
        // Despacha el Job para procesar el CSV
        ProcessCsvUpload::dispatch($path, $request->input('type'));

        return redirect()->back()->with('success', 'Archivo subido y procesándose en segundo plano.');
    }
}

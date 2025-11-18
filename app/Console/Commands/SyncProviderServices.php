<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Support\Str;

class SyncProviderServices extends Command
{
    protected $signature = 'providers:sync-services';
    protected $description = 'Sincroniza los servicios de los proveedores a partir de sus keywords';

    public function handle()
    {
        $this->info('Sincronizando servicios de proveedores...');
        $providers = Provider::all();
        $serviciosCreados = collect();
        foreach ($providers as $provider) {
            if (!$provider->keywords) continue;
            // Separar keywords por coma, punto y coma, o pipe
            $keywords = preg_split('/[,;|]+/', $provider->keywords);
            $ids = [];
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (!$keyword) continue;
                // Normalizar nombre
                $name = Str::limit($keyword, 100);
                // Buscar o crear el servicio
                $service = Service::firstOrCreate(['name' => $name], [
                    'description' => 'Servicio importado desde keywords',
                    'is_active' => true
                ]);
                $ids[] = $service->id;
                $serviciosCreados->push($service->name);
            }
            // Relacionar servicios con el proveedor
            $provider->services()->syncWithoutDetaching($ids);
        }
        $this->info('Servicios sincronizados correctamente.');
        $this->info('Servicios creados/actualizados: ' . $serviciosCreados->unique()->count());
    }
}

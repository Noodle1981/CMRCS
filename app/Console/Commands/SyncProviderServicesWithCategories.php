<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Provider;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class SyncProviderServicesWithCategories extends Command
{
    protected $signature = 'providers:sync-services-categories';
    protected $description = 'Sincroniza servicios de proveedores y los agrupa automáticamente en categorías';

    // Sinónimos agrupados por categoría
    protected $categoryMap = [
        'Agricultura' => ['actividad agricola', 'agricultura', 'agriculture', 'plant nutrition', 'food', 'food & beverage', 'agriculture studies'],
        'Consultoría' => ['consultoria', 'consulting', 'due diligence', 'auditoria', 'auditoría energética', 'estudios', 'estudios ambientales'],
        'Capacitación' => ['capacitacion', 'training', 'formación', 'formacion', 'cursos', 'workshop'],
        'Normas y Certificaciones' => ['normas iram', 'normas iso', 'iso 14001', 'iso 45001', 'certificación', 'certificaciones'],
        'Productos Forestales' => ['productos forestales', 'celulosa', 'madera aserrada', 'paneles', 'papel', 'forestal'],
        'Medio Ambiente' => ['gestión medioambiental', 'medio ambiente', 'ambiental', 'environmental'],
        'Tecnología' => ['tecnologías', 'technology', 'software', 'sistemas', 'automatización'],
        'Seguridad Laboral' => ['higiene y seguridad', 'seguridad laboral', 'safety', 'higiene', 'laboral'],
        'Energía' => ['energía', 'energy', 'auditoría energética', 'consultoría energética'],
        'Transporte y Logística' => ['transporte', 'logística', 'logistics', 'shipping'],
        'Construcción' => ['construcción', 'obra', 'infraestructura', 'building', 'construction'],
        'Legal' => ['legal', 'jurídico', 'abogado', 'law', 'compliance'],
        'Finanzas' => ['finanzas', 'contabilidad', 'accounting', 'finance', 'banca'],
        'Recursos Humanos' => ['recursos humanos', 'rrhh', 'human resources', 'selección', 'reclutamiento'],
        'Marketing' => ['marketing', 'publicidad', 'comunicación', 'branding', 'mercadeo'],
        'Salud' => ['salud', 'health', 'medicina', 'medical', 'sanitario'],
        'Alimentos' => ['alimentos', 'food', 'bebidas', 'beverage', 'nutrición'],
        'Educación' => ['educación', 'education', 'enseñanza', 'docencia', 'capacitación'],
        'Servicios Generales' => ['servicios generales', 'general services', 'mantenimiento', 'facility'],
    ];

    public function handle()
    {
        $this->info('Sincronizando servicios y agrupando en categorías...');
        $providers = Provider::all();
        foreach ($providers as $provider) {
            if (!$provider->keywords) continue;
            $keywords = preg_split('/[,;|]+/', $provider->keywords);
            $ids = [];
            foreach ($keywords as $keyword) {
                $keyword = trim(Str::lower($keyword));
                if (!$keyword) continue;
                $categoryName = $this->findCategory($keyword);
                $category = $categoryName ? ServiceCategory::firstOrCreate(['nombre' => $categoryName]) : null;
                $service = Service::firstOrCreate([
                    'tipo_servicio' => Str::limit($keyword, 100)
                ], [
                    'description' => 'Servicio importado desde keywords',
                    'is_active' => true,
                    'service_category_id' => $category ? $category->id : null
                ]);
                if ($category && $service->service_category_id !== $category->id) {
                    $service->service_category_id = $category->id;
                    $service->save();
                }
                $ids[] = $service->id;
            }
            $provider->services()->syncWithoutDetaching($ids);
        }
        $this->info('Servicios y categorías sincronizados correctamente.');
    }

    protected function findCategory($keyword)
    {
        foreach ($this->categoryMap as $category => $synonyms) {
            foreach ($synonyms as $syn) {
                if (Str::contains($keyword, $syn)) {
                    return $category;
                }
            }
        }
        return null;
    }
}

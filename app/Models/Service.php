<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_servicio', 'description', 'is_active'
    ];

    public function providers() {
        return $this->belongsToMany(Provider::class, 'provider_service');
    }

    public function category() {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}

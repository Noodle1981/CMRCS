<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProspectController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UploadController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Vistas para usuarios no admin (sin prefijo /admin)
    Route::get('/mis-prospectos', [ProspectController::class, 'myProspects'])->name('prospects.my');
    Route::get('/prospectos-sin-asignar', [ProspectController::class, 'unassigned'])->name('prospects.unassigned');
    Route::post('/asignar-prospectos', [ProspectController::class, 'assign'])->name('prospects.assign');
    Route::get('/cargar-csv', [UploadController::class, 'create'])->name('uploads.create');
    Route::post('/cargar-csv', [UploadController::class, 'store'])->name('uploads.store');
    Route::get('/proveedores/{provider}', [CompanyController::class, 'show'])->name('providers.show');
    Route::get('/servicios', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/servicios/{service}/editar', [ServiceController::class, 'edit'])->name('services.edit');
    Route::get('/mis-prospectos/companias', [ProspectController::class, 'assignedCompanies'])->name('prospects.companies');
    Route::get('/mis-prospectos/proveedores', [ProspectController::class, 'assignedProviders'])->name('prospects.providers');
    Route::get('/providers/match', [ServiceController::class, 'match'])->name('providers.match');


    // --- ZONA DE ADMINISTRACIÓN ---
    Route::prefix('admin')->name('admin.')->middleware(['role:super-admin'])->group(function () {
        // Solo el admin puede crear usuarios y ver métricas internas
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        // Ruta para mostrar detalle de una company
        Route::get('companies/{company}', [\App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('companies.show');
        // Aquí puedes agregar rutas para métricas, reportes, dashboard interno, etc.
    });
});

require __DIR__.'/auth.php';

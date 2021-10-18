<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$router->get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
$router->get('login', [App\Http\Controllers\Auth\LoginController::class,'index'])->name('login');
$router->post('authenticate', [App\Http\Controllers\Auth\LoginController::class,'authenticate'])->name('authenticate');

Route::middleware(['guest'])->get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function (){

    Route::prefix('tablero-de-control')->group(function (){
        Route::get('/',[App\Http\Controllers\TableroDeControl::class, 'index'])->name('tablero-de-control');
        Route::get('/carril/{carril}',[App\Http\Controllers\TableroDeControl::class, 'show'])->name('tablero-de-control.show');
    });

    Route::prefix('reportes')->group(function (){
        Route::get('/', [App\Http\Controllers\ReportesController::class, 'index'])->name('reportes');
    });

    Route::middleware('config.permissions')->prefix('configuracion')->group(function (){
        /*Index*/
        Route::get('/', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('configuracion');
        /* Fin Index*/

        /*Usuarios*/
        Route::get('/usuarios', [App\Http\Controllers\ConfiguracionController::class, 'showAdminUsuarios'])->name('configuracion.usuarios');
        Route::get('/usuarios/create', [App\Http\Controllers\ConfiguracionController::class, 'createAdminUsuarios'])->name('configuracion.usuarios.create');
        Route::post('/usuarios/store', [App\Http\Controllers\ConfiguracionController::class, 'storeAdminUsuarios'])->name('configuracion.usuarios.store');
        Route::get('/usuarios/edit/{user}', [App\Http\Controllers\ConfiguracionController::class, 'editAdminUsuarios'])->name('configuracion.usuarios.edit');
        Route::post('/usuarios/update', [App\Http\Controllers\ConfiguracionController::class, 'updateAdminUsuarios'])->name('configuracion.usuarios.update');
        Route::delete('/usuarios/delete/{user}', [App\Http\Controllers\ConfiguracionController::class, 'deleteAdminUsuarios'])->name('configuracion.usuarios.delete');
        /*Fin usuarios*/

        /*Tarifas*/
        Route::get('/tarifas', [App\Http\Controllers\ConfiguracionController::class, 'showAdminTarifas'])->name('configuracion.tarifas');
        Route::post('/tarifas/update', [App\Http\Controllers\ConfiguracionController::class, 'updateAdminTarifas'])->name('configuracion.tarifas.update');
        Route::post('/tarifas/store', [App\Http\Controllers\ConfiguracionController::class, 'storeAdminTarifas'])->name('configuracion.tarifas.store');
        /*Fin tarifas*/

        /*Vehiculos*/
        Route::get('/vehiculos', [App\Http\Controllers\ConfiguracionController::class, 'showAdminVehiculos'])->name('configuracion.vehiculos');
        Route::get('/vehiculos/create', [App\Http\Controllers\ConfiguracionController::class, 'createAdminVehiculos'])->name('configuracion.vehiculos.create');
        Route::post('/vehiculos/store', [App\Http\Controllers\ConfiguracionController::class, 'storeAdminVehiculos'])->name('configuracion.vehiculos.store');
        Route::get('/vehiculos/edit/{vehiculo}', [App\Http\Controllers\ConfiguracionController::class, 'editAdminVehiculos'])->name('configuracion.vehiculos.edit');
        Route::patch('/vehiculos/update', [App\Http\Controllers\ConfiguracionController::class, 'updateAdminVehiculos'])->name('configuracion.vehiculos.update');
        Route::delete('/vehiculos/delete/{vehiculo}', [App\Http\Controllers\ConfiguracionController::class, 'destroyAdminVehiculos'])->name('configuracion.vehiculos.destroy');
        /*Fin Vehiculos*/

    });


    Route::prefix('portico-aforador')->group(function (){
        Route::get('/', [App\Http\Controllers\PorticoAforadorController::class, 'index'])->name('portico-aforador');
        Route::get('filer-portico-aforador',[App\View\Components\FilterPortico::class,'filter'])->name('portico-aforador.filter');
        Route::get('create-portico-aforador',[App\View\Components\FilterPortico::class,'createLoadDocuments'])->name('portico-aforador.create_data');
        Route::post('store-documents',[App\View\Components\FilterPortico::class,'storeDocuments'])->name('portico-aforador.documents.store');
    });

    Route::prefix('reportes')->group(function (){
        Route::get('/', [App\Http\Controllers\ReportesController::class, 'index'])->name('reportes');
        Route::get('/data', [App\Http\Controllers\ReportesController::class, 'filterData'])->name('reportes.filterData');
    });

    Route::get('chartjs_aforo_mensual', [App\Http\Controllers\ChartController::class, 'index'])->name('chartjs.index');
    Route::get('cartjs_aforo_diario', [App\Http\Controllers\ChartController::class, 'getChartAforoDiario'])->name('chartjs.aforo-diario');
    Route::get('cartjs_aforo_hourly', [App\Http\Controllers\ChartController::class, 'getChartAforoHourly'])->name('chartjs.aforo-hourly');


});




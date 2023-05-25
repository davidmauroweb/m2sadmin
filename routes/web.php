<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PresupuestosController;
use App\Http\Controllers\ServersController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/planes', [PlanesController::class, 'index'])->name('planes.index');
Route::post('/planes', [PlanesController::class, 'store'])->name('planes.store');
Route::delete('/planes/{idPlan}', [PlanesController::class, 'destroy'])->name('planes.destroy');
Route::put('/planes/{plan}', [PlanesController::class, 'update'])->name('planes.update');

Route::get('/server', [ServersController::class, 'index'])->name('servers.index');
Route::post('/server', [ServersController::class, 'store'])->name('servers.store');
Route::delete('/server/{idServer}', [ServersController::class, 'destroy'])->name('servers.destroy');
Route::put('/server/{server}', [ServersController::class, 'update'])->name('servers.update');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::delete('/clientes/{idCliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');
Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');

Route::get('/clientes/servidor/{idServer}', [ClientesController::class, 'show'])->name('clientes.show');

Route::get('/presupuestos', [PresupuestosController::class, 'index'])->name('presupuestos.index');
Route::post('/presupuestos', [PresupuestosController::class, 'store'])->name('presupuestos.store');
Route::delete('/presupuestos/{pre}', [PresupuestosController::class, 'destroy'])->name('presupuestos.destroy');
Route::put('/presupuestos/{pre}', [PresupuestosController::class, 'update'])->name('presupuestos.update');

Route::get('/presupuestos/presupuesto/{idPresupuesto}', [PresupuestosController::class, 'show'])->name('presupuestos.show');


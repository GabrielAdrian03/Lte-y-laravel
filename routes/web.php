<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\DescripcionVehiculoController;
use App\Http\Controllers\FalloVehiculoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ...ruta para descargar informe en PDF...
Route::get('informe/descargar', [ArchivoController::class, 'descargarInforme'])->name('informe.descargar');

// ...ruta para guardar fallo vehicular...
Route::post('vehiculos/{vehiculo}/fallo', [FalloVehiculoController::class, 'store'])->name('fallo.store');

// ...ruta para la vista de descripción del vehículo...;
Route::get('vehiculos/{vehiculo}/descripcion', [DescripcionVehiculoController::class, 'create'])->name('vehiculos.descripcion.create');
Route::post('vehiculos/{vehiculo}/descripcion', [DescripcionVehiculoController::class, 'store'])->name('vehiculos.descripcion.store');

// ...ruta para la vista de vehículos...;
Route::get('vehiculos/create', [VehiculoController::class, 'create'])->name('vehiculos.create');
Route::post('vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');

// ...ruta para la vista de análisis...;
Route::get('analisis', [EmpleadoController::class, 'tareasAsignadas'])->name('analisis');

// ...ruta para la vista de vacaciones...;
Route::middleware(['auth'])->group(function () {
    Route::get('/vacaciones', [VacationController::class, 'index'])->name('vacaciones.index');
    Route::post('/vacaciones', [VacationController::class, 'store'])->name('vacaciones.store');
});

// ...ruta para cerrar sesión...;
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// ...ruta para asignar tareas a empleados...;
Route::post('empleados/{id}/asignar-tareas', [EmpleadoController::class, 'asignarTareas'])->name('empleados.asignarTareas');

// ...ruta de la vista de Empleados...;
Route::get('empleados', [EmpleadoController::class, 'index'])->name('empleados.index');

// ...ruta de la vista de Empleados...
Route::get('empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::post('empleados', [EmpleadoController::class, 'store'])->name('empleados.store');

// ...ruta de la vista de Análisis...
Route::get('/archivos', function () {
    return view('archivos');
});

Route::post('/archivos/subir', [ArchivoController::class, 'subir'])->name('archivos.subir');
Route::get('/archivos/descargar/{archivo}', [ArchivoController::class, 'descargar'])->name('archivos.descargar');
Route::delete('/archivos/eliminar/{archivo}', [ArchivoController::class, 'eliminar'])->name('archivos.eliminar');

// ...ruta de la vista de Análisis...
//Route::get('/analisis', function () {
//    return view('analisis');
//});

// ...ruta de POO...
Route::get('/poo', function () {
    return view('poo');
});

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Autenticación
Auth::routes();

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Tareas
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');
Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy');

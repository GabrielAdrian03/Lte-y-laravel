<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArchivoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ...ruta de la vista de Análisis...
Route::get('/archivos', function () {
    return view('archivos');
});

Route::post('/archivos/subir', [ArchivoController::class, 'subir'])->name('archivos.subir');
Route::get('/archivos/descargar/{archivo}', [ArchivoController::class, 'descargar'])->name('archivos.descargar');
Route::delete('/archivos/eliminar/{archivo}', [ArchivoController::class, 'eliminar'])->name('archivos.eliminar');

// ...ruta de la vista de Análisis...
Route::get('/analisis', function () {
    return view('analisis');
});

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

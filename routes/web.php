<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    HomeController,
    TareaController,
    ArchivoController,
    EmpleadoController,
    VacationController,
    VehiculoController,
    DescripcionVehiculoController,
    FalloVehiculoController,
    ModeloController,
    AdminController,
    DashboardController,
    InformeController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Todas las rutas web del sistema. Limpio y sin duplicados.
|--------------------------------------------------------------------------
*/

// Ruta para descargar informe CSV nuevo de empleados
//Route::get('informe/descargar', 
//[InformeController::class, 'descargar'])
//->name('informe.descargar');

// Ruta para asignar todas las tareas a un empleado
Route::post('/empleados/{id}/asignar-todo', [EmpleadoController::class, 'asignarTodo'])->name('empleados.asignarTodo');

// Ruta para la vista principal del módulo POO
Route::get('/poo', [DashboardController::class, 'index'])->name('poo');


// Ruta para el dashboard de administración
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');


// rutas para el módulo de clientes
use App\Http\Controllers\ClienteController;

// rutas para el módulo de clientes
Route::resource('clientes', ClienteController::class)->only(['index', 'create', 'store']);

//RUTA PRINCIPAL Y AUTENTICACIÓN
Route::get('/', fn() => view('welcome'));
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// MÓDULO VEHICULAR (Vehículos, Fallos, Descripciones)

// Página principal del módulo (usa el controlador)
//Route::get('/poo', [VehiculoController::class, 'index'])->name('poo');

// CRUD de vehículos
Route::resource('vehiculos', VehiculoController::class);

// Agregar descripción a un vehículo
Route::get('vehiculos/{vehiculo}/descripcion', [DescripcionVehiculoController::class, 'create'])
    ->name('vehiculos.descripcion.create');
Route::post('vehiculos/{vehiculo}/descripcion', [DescripcionVehiculoController::class, 'store'])
    ->name('vehiculos.descripcion.store');

// Guardar fallo vehicular
Route::post('vehiculos/{vehiculo}/fallo', [FalloVehiculoController::class, 'store'])
    ->name('fallo.store');

// Obtener modelos por marca (para selects dinámicos)
Route::get('modelos-por-marca/{marca_id}', [ModeloController::class, 'getModelos'])
    ->name('modelos.por.marca');

// Descargar informe PDF
Route::get('informe/descargar', 
[ArchivoController::class, 'descargarInforme'])
    ->name('informe.descargar');

//
// 👥 MÓDULO EMPLEADOS
//
Route::get('empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
//Route::get('empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::post('empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
Route::post('empleados/{id}/asignar-tareas', [EmpleadoController::class, 'asignarTareas'])
    ->name('empleados.asignarTareas');
// Empleados CRUD
Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create')->middleware('permission:crear empleados');
Route::get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit')->middleware('permission:editar empleados');
Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update')->middleware('permission:editar empleados');
Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy')->middleware('permission:borrar empleados');


//
// 🗓️ MÓDULO VACACIONES
//
Route::middleware(['auth'])->group(function () {
    Route::get('/vacaciones', [VacationController::class, 'index'])->name('vacaciones.index');
    Route::post('/vacaciones', [VacationController::class, 'store'])->name('vacaciones.store');
});

// ...ruta para la vista de análisis...; 
Route::get('analisis', [EmpleadoController::class, 'tareasAsignadas'])->name('analisis');

//
// 📁 MÓDULO ARCHIVOS
//
Route::get('/archivos', [ArchivoController::class, 'index'])->name('archivos.index');
Route::post('/archivos/subir', [ArchivoController::class, 'subir'])->name('archivos.subir');
Route::get('/archivos/descargar/{archivo}', [ArchivoController::class, 'descargar'])->name('archivos.descargar');
Route::delete('/archivos/eliminar/{archivo}', [ArchivoController::class, 'eliminar'])->name('archivos.eliminar');
//Route::get('/archivos', function () {
//    return view('archivos');
//})->name('archivos.index');
//
// 🧰 MÓDULO TAREAS
//
Route::get('/tareas', [TareaController::class, 'index'])
    ->name('tareas.index');

Route::get('/tareas/create', [TareaController::class, 'create'])
    ->name('tareas.create')
    ->middleware(['permission:crear tareas']);

Route::post('/tareas', [TareaController::class, 'store'])
    ->name('tareas.store')
    ->middleware(['permission:crear tareas']);

Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])
    ->name('tareas.edit')
    ->middleware(['permission:editar tareas']);

Route::put('/tareas/{tarea}', [TareaController::class, 'update'])
    ->name('tareas.update')
    ->middleware(['permission:editar tareas']);

Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])
    ->name('tareas.destroy')
    ->middleware(['permission:eliminar tareas']);

//
// 🚪 CERRAR SESIÓN
//
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('sesiones', function () {
    return view('sesiones.index');
});
Route::get('mostrar/tablaClases', function () {
    return view('mostrar.tablaClases');
});


// MateriaController
Route::get('configurar/materias/index',[App\Http\Controllers\MateriaController::class, 'index'])->name('materias.index');
Route::get('configurar/materias/create',[App\Http\Controllers\MateriaController::class, 'create'])->name('materias.create');
Route::get('configurar/materias/createall',[App\Http\Controllers\MateriaController::class, 'createall'])->name('materias.createall');
Route::post('configurar/materias/create',[App\Http\Controllers\MateriaController::class, 'store'])->name('materias.store');
Route::post('configurar/materias/createall',[App\Http\Controllers\MateriaController::class, 'storeall'])->name('materias.storeall');
Route::get('configurar/materias/{id}/edit',[App\Http\Controllers\MateriaController::class, 'edit'])->name('materias.edit');
Route::put('configurar/materias/{id}',[App\Http\Controllers\MateriaController::class, 'update'])->name('materias.update');
Route::delete('configurar/materias/{id}',[App\Http\Controllers\MateriaController::class, 'destroy'])->name('materias.destroy');

// Route::resource('materias','MateriaController');
Route::put('home/paso/{user:paso}',[App\Http\Controllers\MateriaController::class, 'paso'])->name('paso');

Route::get('home/paso/{user:paso}',[App\Http\Controllers\MateriaController::class, 'paso'])->name('home.paso');
// AulaController

Route::get('configurar/aulas/index',[App\Http\Controllers\AulaController::class, 'index'])->name('aulas.index');
Route::get('configurar/aulas/create',[App\Http\Controllers\AulaController::class, 'create'])->name('aulas.create');
Route::post('configurar/aulas/create',[App\Http\Controllers\AulaController::class, 'store'])->name('aulas.store');
Route::get('configurar/aulas/{id}/edit',[App\Http\Controllers\AulaController::class, 'edit'])->name('aulas.edit');
Route::put('configurar/aulas/{id}/edit',[App\Http\Controllers\AulaController::class, 'update'])->name('aulas.update');
Route::delete('configurar/aulas/{id}/edit',[App\Http\Controllers\AulaController::class, 'destroy'])->name('aulas.destroy');


Route::get('configurar/sesions/index',[App\Http\Controllers\SesionController::class, 'index'])->name('sesions.index');
Route::get('configurar/sesions/create',[App\Http\Controllers\SesionController::class, 'create'])->name('sesions.create');
Route::post('configurar/sesions/create',[App\Http\Controllers\SesionController::class, 'store'])->name('sesions.store');
Route::get('configurar/sesions/{id}/edit',[App\Http\Controllers\SesionController::class, 'edit'])->name('sesions.edit');
Route::put('configurar/sesions/{id}/edit',[App\Http\Controllers\SesionController::class, 'update'])->name('sesions.update');

// ClaseController
Route::get('configurar/clases/index',[App\Http\Controllers\ClaseController::class, 'index'])->name('clases.index');
Route::get('configurar/clases/create',[App\Http\Controllers\ClaseController::class, 'create'])->name('clases.create');
Route::post('configurar/clases/create',[App\Http\Controllers\ClaseController::class, 'store'])->name('clases.store');
Route::get('configurar/clases/{id}/edit',[App\Http\Controllers\ClaseController::class, 'edit'])->name('clases.edit');
Route::put('configurar/clases/{id}/edit',[App\Http\Controllers\ClaseController::class, 'update'])->name('clases.update');
Route::delete('configurar/clases/{id}/edit',[App\Http\Controllers\ClaseController::class, 'destroy'])->name('clases.destroy');

Route::put('home/pasoMenos/{id}',[App\Http\Controllers\PasoController::class, 'updatePasoMenos'])->name('home.updatePasoMenos');
Route::put('home/{id}',[App\Http\Controllers\PasoController::class, 'updatePasoMas'])->name('home.updatePasoMas');


Route::put('home/{user}',[App\Http\Controllers\ClaseController::class, 'paso'])->name('paso');

// EstudianteController
Route::get('configurar/estudiantes/index', [App\Http\Controllers\EstudianteController::class, 'index'])->name('estudiantes.index');
Route::get('configurar/estudiantes/create',[App\Http\Controllers\EstudianteController::class,'create'])->name('estudiantes.create');
Route::post('configurar/estudiantes/create',[App\Http\Controllers\EstudianteController::class, 'store'])->name('estudiantes.store');
Route::get('configurar/estudiantes/{id}/edit',[App\Http\Controllers\EstudianteController::class, 'edit'])->name('estudiantes.edit');
Route::put('configurar/estudiantes/{id}/edit',[App\Http\Controllers\EstudianteController::class,'update'])->name('estudiantes.update');
Route::delete('configurar/estudiantes/{id}/edit',[App\Http\Controllers\EstudianteController::class,'destroy'])->name('estudiantes.destroy');
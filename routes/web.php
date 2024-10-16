<?php

use App\Http\Controllers\EsperaPersonaTallerController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PersonaEsperaTallerController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/panel/principal', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=> 'inscripciones','middleware'=>'auth'],function(){
    Route::get('/index',[InscripcionController::class,'index'])->name('inscripciones.index');
    Route::get('/get-ciclo-dias/{id}',[InscripcionController::class,'getDiasByPeriodAndYear'])->name('inscripciones.dias');
    Route::get('/get-ciclo-taller/{id}',[InscripcionController::class,'getAnioPeriodoByTaller'])->name('inscripciones.taller');
    Route::get('/get-inscritos-ciclo/{id}',[InscripcionController::class,'getInscritoToCicle'])->name('inscripciones.inscritos');
    Route::get('/create/',[InscripcionController::class,'create'])->name('inscripciones.create');
    Route::get('/get-persona/{documento}',[InscripcionController::class,'getPersonaByDocument'])->name('inscripciones.persona');
    Route::get('/get-programa/{id}',[InscripcionController::class,'getProgramaByType'])->name('inscripciones.getprogram');
    Route::get('/get-talleres/{id}',[InscripcionController::class,'getTalleresByType'])->name('inscripciones.gettaller');
    Route::get('/get-ciclos/{id}',[InscripcionController::class,'getCiclosByType'])->name('inscripciones.ciclos');
    Route::get('/get-horarios-ciclos/{id}',[InscripcionController::class,'getCiclosByHorarios'])->name('inscripciones.horarios');
    Route::get('/get-validacion/{tipotaller}/{alumnoid}/inscripciones',[InscripcionController::class,'validateAlumnoInscription'])->name('inscripciones.validacion.isncripciones');
    Route::post('/store',[InscripcionController::class, 'store'])->name('inscripciones.store');
});

Route::group(['prefix'=> 'lista-espera','middleware'=>'auth'],function(){
    Route::get('/index',[EsperaPersonaTallerController::class,'index'])->name('listaespera.index');
    Route::get('/get-personas-espera/{id}',[EsperaPersonaTallerController::class,'getPersonasByTypeTaller'])->name('listaespera.detalle');
    Route::get('/create/{personaid}/{tallerid}',[EsperaPersonaTallerController::class,'create'])->name('listaespera.create');
});

Route::group(['prefix'=>'personas','middleware'=>'auth'], function(){
    Route::get('/index',[PersonaController::class, 'index'])->name('personas.index');
    Route::get('/create',[PersonaController::class, 'create'])->name('personas.create');
    Route::post('/store',[PersonaController::class, 'store'])->name('personas.store');
});

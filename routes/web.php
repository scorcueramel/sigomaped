<?php

use App\Http\Controllers\InscripcionController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/panel/principal', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=> 'inscripciones','middleware'=>'auth'],function(){
    Route::get('/index',[InscripcionController::class,'index'])->name('inscripciones.index');
    Route::get('/create',[InscripcionController::class,'create'])->name('inscripciones.create');
    Route::get('/get-programa/{id}',[InscripcionController::class,'getProgramaByType'])->name('inscripciones.getprogram');
    Route::get('/get-talleres/{id}',[InscripcionController::class,'getTalleresByType'])->name('inscripciones.gettaller');
    Route::get('/get-ciclos/{id}',[InscripcionController::class,'getCiclosByType'])->name('inscripciones.ciclos');
    Route::get('/get-horarios-ciclos/{id}',[InscripcionController::class,'getCiclosByHorarios'])->name('inscripciones.ciclos.horarios');
});

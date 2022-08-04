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
    return view(view:'times.paginainicial');
})->name('PaginaInicial');

Route::get('/cadastrar', function () {
    return view(view:'times.cadastrar');
})->name('cadastrar');

Route::get('/times', function () {
    return view(view:'times.times');
})->name('times');

Route::get('/jogador', function () {
    return view(view:'times.jogadors');
})->name('jogadors');

//Rotas Modulo Campeonato
Route::get('/campeonato', 'App\Http\Controllers\CampeonatosController@index')->name("campeonato.index");
Route::get('/campeonato/cadastrar', 'App\Http\Controllers\CampeonatosController@cadastrarCampeonato')->name("campeonato.cadastrar");
Route::get('/campeonato/pesquisar/formato', 'App\Http\Controllers\CampeonatosController@pesquisar')->name("campeonato.pesquisar/slFormato");
//Route::get('/campeonato/exibir/id', 'App\Http\Controllers\CampeonatosController@exibir')->name("campeonato.exibir");
Route::resource('/campeonato', 'App\Http\Controllers\CampeonatosController');
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

/*Route::get('/', function () {
    return view(view:'times.paginainicial');
})->name('PaginaInicial');*/
Route::get('/', 'App\Http\Controllers\PaginaInicial@index')->name("PaginaInicial");


/*
Route::get('/cadastrar', function () {
    return view(view:'times.cadastrar');
})->name('cadastrar');
*/
Route::get('/cadastrar', 'App\Http\Controllers\CadastroUsuarioController@cadastrar')->name("cadastrar");
 
/*
Route::get('/times', function () {
    return view(view:'times.times');
})->name('times');
*/
Route::get('/times', 'App\Http\Controllers\CadastroTime@cadastrarTimes')->name("times");

Route::get('/jogador', function () {
    return view(view:'times.jogadors');
})->name('jogadors');

Route::resource('/usuario', 'App\Http\Controllers\CadastroUsuario');

Route::resource('/usuario', 'App\Http\Controllers\CadastroUsuarioController');


//Rotas Modulo Campeonato
Route::get('/campeonato', 'App\Http\Controllers\CampeonatosController@index')->name("campeonato.index");
Route::get('/campeonato/cadastrar', 'App\Http\Controllers\CampeonatosController@cadastrarCampeonato')->name("campeonato.cadastrar");
Route::get('/campeonato/{idCampeonato}/adicionarTime/', 'App\Http\Controllers\CampeonatosController@adicionarTime')->name("campeonato.adicionarTime");
Route::get('/campeonato/buscaJogadores/', 'App\Http\Controllers\CampeonatosController@buscaJogadores')->name("campeonato.buscaJogadores");
Route::get('/campeonato/salvaTimesJogadoresCampeonato/', 'App\Http\Controllers\CampeonatosController@salvaTimesJogadoresCampeonato')->name("campeonato.salvaTimesJogadoresCampeonato");
//ver essa rota
Route::post('/campeonato/pesquisar/formato', 'App\Http\Controllers\CampeonatosController@pesquisar')->name("campeonato.pesquisar/slFormato");
Route::resource('/campeonato', 'App\Http\Controllers\CampeonatosController');
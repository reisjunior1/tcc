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


Route::get('/', 'App\Http\Controllers\PaginaInicial@index')->name("PaginaInicial");

Route::get('/cadastrar', 'App\Http\Controllers\CadastroUsuarioController@cadastrar')->name("usuario.cadastrar");

Route::get('/local', 'App\Http\Controllers\CadastroLocalController@cadastrarLocal')->name("local.cadastrar");
Route::post('/local', 'App\Http\Controllers\CadastroLocalController@cadastrarLocal')->name("local.cadastrar");

Route::get('/times', 'App\Http\Controllers\CadastroTimeController@cadastrarTimes')->name("time.cadastrar");
Route::post('/times', 'App\Http\Controllers\CadastroTimeController@store')->name("time.cadastrar");
//Route::resource('/times', 'App\Http\Controllers\CadastroTimeController');

Route::get('/jogador', function () {
    return view(view:'times.jogadors');
})->name('jogadors');

Route::resource('/usuario', 'App\Http\Controllers\CadastroUsuario');

Route::resource('/usuario', 'App\Http\Controllers\CadastroUsuarioController');


//Rotas Modulo Campeonato
Route::get('/campeonato', 'App\Http\Controllers\CampeonatosController@index')->name("campeonato.index");
Route::get('/campeonato/cadastrar', 'App\Http\Controllers\CampeonatosController@cadastrarCampeonato')->name("campeonato.cadastrar");
Route::get('/campeonato/deleta', 'App\Http\Controllers\CampeonatosController@deletarCampeonato')->name("campeonato.deletaCampeonato");
Route::get('/campeonato/{idCampeonato}/adicionarTime/', 'App\Http\Controllers\CampeonatosController@adicionarTime')->name("campeonato.adicionarTime");
Route::get('/campeonato/buscaJogadores/', 'App\Http\Controllers\CampeonatosController@buscaJogadores')->name("campeonato.buscaJogadores");
Route::get('/campeonato/salvaTimesJogadoresCampeonato/', 'App\Http\Controllers\CampeonatosController@salvaTimesJogadoresCampeonato')->name("campeonato.salvaTimesJogadoresCampeonato");
Route::get('/campeonato/apagaTimesCampeonato/', 'App\Http\Controllers\CampeonatosController@apagaTimesCampeonato')->name("campeonato.apagaTimesCampeonato");
Route::get('/campeonato/{idCampeonato}/partidas/', 'App\Http\Controllers\CampeonatosController@partidas')->name("campeonato.partidas");
Route::get('/campeonato/{idCampeonato}/criarPartida/', 'App\Http\Controllers\CampeonatosController@criarPartida')->name("campeonato.criarPartida");
Route::get('/campeonato/{idCampeonato}/editarPartida/', 'App\Http\Controllers\CampeonatosController@editarPartida')->name("campeonato.editarPartida");
Route::get('/campeonato/{idCampeonato}/excluirPartida/', 'App\Http\Controllers\CampeonatosController@excluirPartida')->name("campeonato.excluirPartida");
Route::post('/campeonato/pesquisar/', 'App\Http\Controllers\CampeonatosController@pesquisar')->name("campeonato.pesquisar");
Route::get('/campeonato/{idCampeonato}/salvaPartida/', 'App\Http\Controllers\CampeonatosController@salvaPartida')->name("campeonato.salvaPartida");
Route::resource('/campeonato', 'App\Http\Controllers\CampeonatosController');

//Rotas Login
Route::get('/login', 'App\Http\Controllers\LoginController@index')->name("login.login");
Route::post('/login/entrar', 'App\Http\Controllers\LoginController@entrar')->name("login.entrar");
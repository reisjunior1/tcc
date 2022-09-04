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
 

Route::get('/times', 'App\Http\Controllers\CadastroTimeController@cadastrarTimes')->name("time.cadastrar");
/*Route::resource('/times', 'App\Http\Controllers\CadastroTimesController');*/

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
//ver essa rota
Route::post('/campeonato/pesquisar/', 'App\Http\Controllers\CampeonatosController@pesquisar')->name("campeonato.pesquisar");
Route::resource('/campeonato', 'App\Http\Controllers\CampeonatosController');
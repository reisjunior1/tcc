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
Route::get('/cadastrar', 'App\Http\Controllers\CadastroUsuario@cadastrar')->name("cadastrar");
 
/*
Route::get('/times', function () {
    return view(view:'times.times');
})->name('times');
*/
Route::get('/times', 'App\Http\Controllers\CadastroTime@cadastrarTimes')->name("times");

Route::get('/jogador', function () {
    return view(view:'times.jogadors');
})->name('jogadors');



//Rotas Modulo Campeonato
Route::get('/campeonato', 'App\Http\Controllers\CampeonatosController@index')->name("campeonato.index");
Route::get('/campeonato/cadastrar', 'App\Http\Controllers\CampeonatosController@cadastrarCampeonato')->name("campeonato.cadastrar");
Route::get('/campeonato/{idCampeonato}/adicionarTime/{idTime?}', 'App\Http\Controllers\CampeonatosController@adicionarTime')->name("campeonato.adicionarTime");
Route::get('/campeonato/pesquisar/formato', 'App\Http\Controllers\CampeonatosController@pesquisar')->name("campeonato.pesquisar/slFormato");
Route::resource('/campeonato', 'App\Http\Controllers\CampeonatosController');
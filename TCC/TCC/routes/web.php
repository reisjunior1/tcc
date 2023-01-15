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

//Pagina Inicial
Route::get('/', 'App\Http\Controllers\PaginaInicial@index')->name("PaginaInicial");

//Rotas de Usuario
Route::get('/cadastrar', 'App\Http\Controllers\CadastroUsuarioController@cadastrar')
    ->name("usuario.cadastrar");

Route::put('/usuario/editar', 'App\Http\Controllers\CadastroUsuarioController@update')
    ->name("usuario.editar");

Route::get('/usuario/{idUsuario}/atualizarSenha', 'App\Http\Controllers\CadastroUsuarioController@atualizarSenha')
    ->name("usuario.atualizarSenha");

Route::get('/usuario/validaAlterarSenha/', 'App\Http\Controllers\CadastroUsuarioController@validaAlterarSenha')
    ->name("usuario.validaAlterarSenha");

Route::get('/usuario/sair/', 'App\Http\Controllers\CadastroUsuarioController@sair')
    ->name("usuario.sair");

Route::get('/usuario/tipoUsuario/', 'App\Http\Controllers\CadastroUsuarioController@tipoUsuario')
    ->name("usuario.tipo");

Route::get('/usuario/pesquisarPapel/{pesquisar?}/{recuperarDados?}', 'App\Http\Controllers\CadastroUsuarioController@pesquisarPapel')
    ->name("usuario.pesquisarPapel");

Route::post('/usuario/pesquisarPapel/{pesquisar?}/{recuperarDados?}', 'App\Http\Controllers\CadastroUsuarioController@pesquisarPapel')
    ->name("usuario.pesquisarPapel");

Route::get('/usuario/validaTipoUsuario/', 'App\Http\Controllers\CadastroUsuarioController@validaTipoUsuario')
    ->name("usuario.validaTipoUsuario");

Route::get('/usuario/removePapel/{usuarioId}/{papel}/{dados}', 'App\Http\Controllers\CadastroUsuarioController@removePapel')
    ->name("usuario.removePapel");

Route::resource('/usuario', 'App\Http\Controllers\CadastroUsuario');
Route::resource('/usuario', 'App\Http\Controllers\CadastroUsuarioController');

//Rotas de Local
Route::get('/local', 'App\Http\Controllers\CadastroLocalController@cadastrarLocal')->name("local.cadastrar");
Route::post('/local', 'App\Http\Controllers\CadastroLocalController@cadastrarLocal')->name("local.cadastrar");

//Rotas de Times
define("TIMES_CONTROLLER", 'App\Http\Controllers\TimeController');

Route::get('/time', TIMES_CONTROLLER.'@index')
    ->name("time.index");
    
Route::get('/time/{idTime}/gerenciar', TIMES_CONTROLLER.'@gerenciar')
    ->name("time.gerenciar");

Route::get('/time/cadastrar', TIMES_CONTROLLER.'@cadastrar')
    ->name("time.cadastrar");

Route::post('/time/{idUsuario}/salvar', TIMES_CONTROLLER.'@salvar')
    ->name("time.salvar");

Route::resource('/time', TIMES_CONTROLLER);

//Rotas Jogador
Route::get('/jogador', function () {
    return view(view:'times.jogadors');
})->name('jogadors');

Route::get('/cadastrojogador', 'App\Http\Controllers\CadastroJogadoresController@cadastrarJogar')->name("time.cadastrajogadors");
Route::post('/cadastrojogadorr', 'App\Http\Controllers\CadastroJagadoresController@salvejogador')->name("time.salvajagadors");
Route::resource('/cadastrojogador', 'App\Http\Controllers\CadastrojogadoresController');

//Rotas Modulo Campeonato
define("CAMPEONATOS_CONTROLLER", 'App\Http\Controllers\CampeonatosController');

Route::get('/campeonato', CAMPEONATOS_CONTROLLER.'@index')
    ->name("campeonato.index");

Route::get('/campeonato/cadastrar', CAMPEONATOS_CONTROLLER.'@cadastrarCampeonato')
    ->name("campeonato.cadastrar");

Route::get('/campeonato/deleta', CAMPEONATOS_CONTROLLER.'@deletarCampeonato')
    ->name("campeonato.deletaCampeonato");

Route::get('/campeonato/{idCampeonato}/adicionarTime/', CAMPEONATOS_CONTROLLER.'@adicionarTime')
    ->name("campeonato.adicionarTime");

Route::get('/campeonato/buscaJogadores/', CAMPEONATOS_CONTROLLER.'@buscaJogadores')
    ->name("campeonato.buscaJogadores");

Route::get('/campeonato/salvaTimesJogadoresCampeonato/', CAMPEONATOS_CONTROLLER.'@salvaTimesJogadoresCampeonato')
    ->name("campeonato.salvaTimesJogadoresCampeonato");

Route::get('/campeonato/apagaTimesCampeonato/', CAMPEONATOS_CONTROLLER.'@apagaTimesCampeonato')
    ->name("campeonato.apagaTimesCampeonato");

Route::get('/campeonato/{idCampeonato}/partidas/', CAMPEONATOS_CONTROLLER.'@partidas')
    ->name("campeonato.partidas");

Route::get('/campeonato/{idCampeonato}/criarPartida/', CAMPEONATOS_CONTROLLER.'@criarPartida')
    ->name("campeonato.criarPartida");

Route::get('/campeonato/{idCampeonato}/editarPartida/', CAMPEONATOS_CONTROLLER.'@editarPartida')
    ->name("campeonato.editarPartida");

Route::get('/campeonato/{idCampeonato}/excluirPartida/', CAMPEONATOS_CONTROLLER.'@excluirPartida')
    ->name("campeonato.excluirPartida");

Route::post('/campeonato/pesquisar/', CAMPEONATOS_CONTROLLER.'@pesquisar')
    ->name("campeonato.pesquisar");

Route::get('/campeonato/{idCampeonato}/salvaPartida/', CAMPEONATOS_CONTROLLER.'@salvaPartida')
    ->name("campeonato.salvaPartida");

Route::get('/campeonato/{idPartida}/editaPartida/', CAMPEONATOS_CONTROLLER.'@editaPartida')
    ->name("campeonato.editaPartida");

Route::get('/campeonato/{idPartida}/encerraPartida/', CAMPEONATOS_CONTROLLER.'@encerraPartida')
    ->name("campeonato.encerraPartida");

Route::get('/campeonato/validaEncerrarPartida/', CAMPEONATOS_CONTROLLER.'@validaEncerrarPartida')
    ->name("campeonato.validaEncerrarPartida");

Route::get('/campeonato/{idPartida}/detalhesPartida/', CAMPEONATOS_CONTROLLER.'@detalhesPartida')
    ->name("campeonato.detalhesPartida");

Route::get('/campeonato/{idPartida}/editarResultado/', CAMPEONATOS_CONTROLLER.'@editarResultado')
    ->name("campeonato.editarResultado");

Route::get('/campeonato/validaAlterarResultado/', CAMPEONATOS_CONTROLLER.'@validaAlterarResultado')
    ->name("campeonato.validaAlterarResultado");

Route::resource('/campeonato', CAMPEONATOS_CONTROLLER);

//Rotas Login
Route::get('/login', 'App\Http\Controllers\LoginController@index')->name("login.login");
Route::post('/login/entrar', 'App\Http\Controllers\LoginController@entrar')->name("login.entrar");
Route::get('login', 'App\Http\Controllers\LoginController@index')->name("login.login");
Route::post('/login/entrar', 'App\Http\Controllers\LoginController@entrar')->name("login.entrar");
//Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'perfil'])->name('login.perfil');
//Route::post('login', [ 'as' => 'login.login', 'uses' => 'LoginController@do']);

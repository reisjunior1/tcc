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
Route::get('/local', 'App\Http\Controllers\CadastroLocalController@index')
    ->name("local.index");

Route::get('/local/cadastrar/{idLocal?}', 'App\Http\Controllers\CadastroLocalController@cadastrarLocal')
    ->name("local.cadastrarLocal");

Route::put('/local', 'App\Http\Controllers\CadastroLocalController@cadastrarLocal')
    ->name("local.cadastrar");

Route::post('/local/salva/', 'App\Http\Controllers\CadastroLocalController@store')
    ->name("local.salva");

Route::get('/local/edita/{id}', 'App\Http\Controllers\CadastroLocalController@update')
    ->name("local.edita");

Route::get('/local/{idTime}/ativarDesativar', 'App\Http\Controllers\CadastroLocalController@ativarDesativar')
    ->name("local.ativarDesativar");

//Route::resource('/local', 'App\Http\Controllers\CadastroLocalController');

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

Route::get('/time/{idTime}/ativarDesativar', TIMES_CONTROLLER.'@ativarDesativar')
    ->name("time.ativarDesativar");

Route::get('/time/{idTime}/adicionaJogador', TIMES_CONTROLLER.'@adicionaJogador')
    ->name("time.adicionaJogador");

Route::get('/time/{idTime}/validaAdicionarJogador', TIMES_CONTROLLER.'@validaAdicionarJogador')
    ->name("time.validaAdicionarJogador");

Route::get('/time/{idTime}/removeJogador/{id}', TIMES_CONTROLLER.'@removeJogador')
    ->name("time.removeJogador");

Route::resource('/time', TIMES_CONTROLLER);

//Rotas Jogador
Route::get('/jogador', 'App\Http\Controllers\CadastroJagadoresController@index')
    ->name("jogador.index");

Route::get('/jogador/cadastrar/{idJogador?}', 'App\Http\Controllers\CadastroJagadoresController@cadastrar')
    ->name("jogador.cadastrar");

/*Route::get('/cadastrojogador', 'App\Http\Controllers\CadastroJogadoresController@cadastrarJogar')
    ->name("time.cadastrajogadors");
Route::post('/cadastrojogadorr', 'App\Http\Controllers\CadastroJagadoresController@salvejogador')
    ->name("time.salvajagadors");*/
//Route::resource('/cadastrojogador', 'App\Http\Controllers\CadastrojogadoresController');

Route::get('/jogador/pesquisar/{pesquisar?}/{recuperarDados?}', 'App\Http\Controllers\CadastroJagadoresController@pesquisar')
    ->name("jogador.pesquisar");

Route::get('/jogador/{idJogador}/ativarDesativar/{dados?}', 'App\Http\Controllers\CadastroJagadoresController@ativarDesativar')
    ->name("jogador.ativarDesativar");

Route::post('/jogador/salva/', 'App\Http\Controllers\CadastroJagadoresController@store')
    ->name("jogador.salva");

Route::get('/jogador/edita/{id}', 'App\Http\Controllers\CadastroJagadoresController@update')
    ->name("jogador.edita");

//Route::resource('/jogador', 'App\Http\Controllers\CadastroJagadoresController');

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

Route::get('/campeonato/{idCampeonato}/criarPartida/{idgrupo?}', CAMPEONATOS_CONTROLLER.'@criarPartida')
    ->name("campeonato.criarPartida");

Route::get('/campeonato/{idPartida}/editarPartida/{idgrupo?}', CAMPEONATOS_CONTROLLER.'@editarPartida')
    ->name("campeonato.editarPartida");

Route::get('/campeonato/{idPartida}/excluirPartida/', CAMPEONATOS_CONTROLLER.'@excluirPartida')
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

Route::get('/campeonato/geraSumulaPdf/{idPartida}', CAMPEONATOS_CONTROLLER.'@geraSumulaPdf')
    ->name("campeonato.geraPDF");

Route::get('/campeonato/criarGrupo/{idCampeonato}', CAMPEONATOS_CONTROLLER.'@criarGrupo')
    ->name("campeonato.criarGrupo");


Route::get('/campeonato/salvarGrupo/{idCampeonato}', CAMPEONATOS_CONTROLLER.'@salvarGrupo')
    ->name("campeonato.salvarGrupo");

Route::get('/campeonato/verGrupo/{idGrupo}', CAMPEONATOS_CONTROLLER.'@verGrupo')
    ->name("campeonato.verGrupo");

Route::get('/campeonato/{idGrupo}/adicionarTimeGrupo/', CAMPEONATOS_CONTROLLER.'@adicionarTimeGrupo')
    ->name("campeonato.adicionarTimeGrupo");

Route::get('/campeonato/validaSalvaTimeGrupo/', CAMPEONATOS_CONTROLLER.'@validaSalvaTimeGrupo')
->name("campeonato.validaSalvaTimeGrupo");

Route::get('/campeonato/apagaTimeGrupo/', CAMPEONATOS_CONTROLLER.'@apagaTimeGrupo')
->name("campeonato.apagaTimeGrupo");

Route::get('/campeonato/apagarGrupo/', CAMPEONATOS_CONTROLLER.'@apagarGrupo')
->name("campeonato.apagarGrupo");

Route::get('/campeonato/{idGrupo}/selecionaGrupo/', CAMPEONATOS_CONTROLLER.'@selecionaGrupo')
->name("campeonato.selecionaGrupo");

Route::get('/campeonato/CriaPartidasGrupo/', CAMPEONATOS_CONTROLLER.'@CriaPartidasGrupo')
    ->name("campeonato.CriaPartidasGrupo");

Route::get('/campeonato/chave/', 'App\Http\Controllers\MataMataController@verCampeonato')
    ->name("campeonato.chave");

Route::get('/campeonato/proximaEtapa/', 'App\Http\Controllers\MataMataController@proximaEtapa')
    ->name("campeonato.proximaEtapa");

Route::resource('/campeonato', CAMPEONATOS_CONTROLLER);

//Rotas Abritos
define("ARBRITO_CONTROLLER", 'App\Http\Controllers\ArbritoController');
Route::get('/arbrito/index/', ARBRITO_CONTROLLER . '@index')
    ->name("arbrito.index");

Route::get('/arbrito/cadastrar/{id?}', ARBRITO_CONTROLLER.'@cadastrar')
    ->name("arbrito.cadastrar");

Route::post('/arbrito/salva/', ARBRITO_CONTROLLER .'@store')
    ->name("arbrito.salva");

Route::get('/arbrito/edita/{id}', ARBRITO_CONTROLLER .'@update')
    ->name("arbrito.edita");

Route::get('/arbrito/{idArbrito}/ativarDesativar', ARBRITO_CONTROLLER . '@ativarDesativar')
    ->name("arbrito.ativarDesativar");

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

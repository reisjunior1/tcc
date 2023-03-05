<?php

namespace App\Http\Controllers;


use App\Models\jogador;
use App\Http\Requests\JogadoresRequest;
use Illuminate\Http\Request;

class CadastroJagadoresController extends Controller
{
    //
    private $objUsuario;
    private $objTime;
    private $objJogador;


    public function __construct()
    {
        $this->objJogador = new jogador();
        $this->middleware('auth');
        $this->middleware(['role:AdminTime|AdminGeral']);
    }

    public function index()
    {
        $modelJogadores = new jogador();
        $jogadores = $modelJogadores->lstTodosJogadores();
        //dd($jogadores);
        return view('times/buscaJogadores', compact('jogadores'));
    }

    public function cadastrar($idJogador = null)
    {
        $modelJogador = new jogador();
        $jogador = $modelJogador->lstJogadores([$idJogador]);
        $id = null;
        if (!empty($jogador)) {
            $id = $jogador[0]['id'];
        }
        //dd($jogador);
        return view('times/jogadors', compact('jogador', 'id'));
    }

    public function show($idJogador)
    {
        //dd($idJogador);
    }

    public function store(JogadoresRequest $request)
    {
        $cadastro=$this->objJogador->create([
            'nome'=>$request->inNome,
            'apelido'=>$request->inApelido,
            'cpf'=>$request->inCpf,
            'telefone'=>$request->inTelefone,
            'nacimento'=>$request->inData,
            'email'=>'m@mail.com',
            'Eexcluido'=>0
        ]);
        if ($cadastro) {
            return redirect('jogador');
        }
    }

    public function update(JogadoresRequest $request, $id)
    {
        $cadastro=$this->objJogador->where(['id'=>$id])->update([
            'nome'=>$request->inNome,
            'apelido'=>$request->inApelido,
            'cpf'=>$request->inCpf,
            'telefone'=>$request->inTelefone,
            'nacimento'=>$request->inData,
            'email'=>'m@mail.com',
            'Eexcluido'=>0
        ]);
        if ($cadastro) {
            return redirect('jogador');
        }
    }

    public function pesquisar(Request $request, $pesquisar = null, $recuperaDados = null)
    {
        $dados['mlJogador'] = $request->mlJogador;
        
        if ($recuperaDados) {
            $arrayDados = unserialize(base64_decode($recuperaDados));
            $dados['mlJogador'] = $arrayDados['mlJogador'];
        }
        $modelJogadores = new jogador();
        $jogadores = $modelJogadores->lstTodosJogadores();

        $arrayDados = base64_encode(serialize($dados));
        if ($pesquisar) {
            $modelJogadores = new jogador();
            $arrayJogadores =$modelJogadores->lstJogadores($dados['mlJogador']);
            
            return view(
                'times/buscaJogadores',
                compact('jogadores', 'arrayJogadores', 'dados', 'arrayDados')
            );
        }
    }

    public function ativarDesativar($idJogador, $parametros)
    {
        $modelJogador = new jogador();
        $jogador = $modelJogador->lstJogadores([$idJogador]);

        $nomeJogador = $jogador[0]['nome'];
        if ($jogador[0]['Eexcluido'] == 0) {
            $this->objJogador->where(['id'=>$idJogador])->update([
                'Eexcluido' => 1,
            ]);
            session()->flash('mensagem', "O $nomeJogador foi desativado!");
        } else {
            $this->objJogador->where(['id'=>$idJogador])->update([
                'Eexcluido' => 0,
            ]);
            session()->flash('mensagem', "O $nomeJogador foi ativado!");
        }
        return redirect()->route('jogador.pesquisar', [
            'pesquisar' => 1,
            'recuperarDados' => $parametros,
        ]);
    }
}

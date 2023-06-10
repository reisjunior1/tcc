<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time;
use App\Models\local;
use App\Http\Requests\TimeRequest;
use App\Models\joga_em;
use App\Models\jogador;
use App\Models\arbritos;
use Auth;

class TimeController extends Controller
{
    private $objUsuario;
    private $objTime;
    

    public function __construct()
    {
        $this->objTime = new time();
        $this->middleware('auth');
       // $this->middleware(['role:AdminTime|AdminGeral']);
        
    }
    public function index()
    {
        $modelTime = new time();

        if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminGeral'])) {
            $times = $modelTime->sltTimes();
        } else {
            $times = $modelTime->lstTimesPorIdUsuario(Auth::user()->id);
        }
        //dd($times);
        return view('times/index', compact('times'));
    }

    public function gerenciar($idTime)
    {
        $modelJogaEm = new joga_em();
        $jogadores = $modelJogaEm->lstJogadoresPorTime($idTime, 0, 0);
        return view('times/gerenciar', compact('jogadores', 'idTime'));
    }

    public function adicionaJogador($idTime)
    {
        $modelJogador = new jogador();
        $jogadores = array_column(
            $modelJogador->lstTodosJogadores(0),
            'id'
        );

        $modelJogaEm = new joga_em();
        $jogadoresTime = array_column(
            $modelJogaEm->lstJogadoresPorTime($idTime, 0, 0),
            'id'
        );

        $aux = $modelJogador->lstJogadores(array_diff($jogadores, $jogadoresTime));
        $arrayJogadores = array_column($aux, 'apelido', 'id');
        asort($arrayJogadores, SORT_NATURAL | SORT_FLAG_CASE);

        return view('times.adicionaJogadorTime', compact('arrayJogadores', 'idTime'));
    }

    public function cadastrar()
    {
        return view(view:'times.times');
    }

    public function store(Request $request)
    {
        $cadastro=$this->objTime->create([
            'nome'=>$request->inNometime,
            'sigla'=>$request->inSigla,
            'telefone'=>$request->inTelefone,
            'endereco'=>$request->inEndereco,
            'cidade'=>$request->inCidade,
            'bairro'=>$request->inbairro,
            'complemento'=>$request->inComplemento,
            'bairro'=>$request->inBairro,
            'cep'=>$request->inCep,
            'estado'=>$request->slEstado,
            'id_usuario'=> intval(Auth::user()->id),
            'Eexcluido'=>0,
        ]);
        if($cadastro){
            return redirect('time');
        }
    }

    public function ativarDesativar($idTime)
    {
        $modelTime = new time();
        $time = $modelTime->lstTimes([$idTime]);
        $nomeTime = $time[0]['nome'];
        if ($time[0]['Eexcluido'] == 0) {
            $this->objTime->where(['id'=>$idTime])->update([
                'Eexcluido' => 1,
            ]);
            session()->flash('mensagem', "O $nomeTime foi desativado!");
            return redirect('time');
        } else {
            $this->objTime->where(['id'=>$idTime])->update([
                'Eexcluido' => 0,
            ]);
            session()->flash('mensagem', "O $nomeTime foi ativado!");
            return redirect('time');
        }
    }

    public function validaAdicionarJogador(Request $request, $idTime)
    {
        if (!empty($request->mlJogador)) {
            $modelJogaEm = new joga_em();
            foreach ($request->mlJogador as $jogador) {
                $modelJogaEm->insJogador($idTime, $jogador);
            }
        }
        return redirect()->route('time.gerenciar', ['idTime' => $idTime]);
    }
    
    public function criaramistoso($idTime)
    {  
        
        $modelTime=new time();
        $times=$modelTime->sltTimes();
        $modelLocal = new local();
        $locais= $modelLocal->lstLocais(true);
        $idCampeonato=0;
        $formato=null;
        $grupo=null; 
        $modelArbrito = new arbritos();
        $arbritos = $modelArbrito->lstArbritos(0);


        return view(
            'campeonatos.criaPartidas',
            compact('idCampeonato', 'times', 'locais', 'formato', 'grupo', 'arbritos' ,'idTime')
        );

    }
    public function show(){
        
    }


    public function removeJogador($idTime, $id)
    {
        $modelJogaEm = new joga_em();
        $modelJogaEm->delJogador($id);

        return redirect()->route('time.gerenciar', ['idTime' => $idTime]);
    }



}

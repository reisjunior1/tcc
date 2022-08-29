<?php

namespace App\Http\Controllers;


use App\Models\campeonato;
use App\Models\usuario;
use App\Models\time;
use App\Models\timesParticipantes;
use Illuminate\Http\Request;
use App\Http\Requests\CampeonatosRequest;
use App\Http\Requests\TimesJogadoresRequest;
use App\Models\joga_em;
use App\Models\jogador;
use App\Models\jogadoresParticipantes;
use App\Models\timeParticipantes;
use Illuminate\Support\Facades\DB;


class CampeonatosController extends Controller
{
    private $objUsuario;
    private $objTime;
    private $objCampeonato;

    public function __construct()
    {
        $this->objUsuario = new usuario();
        $this->objTime = new time();
        $this->objCampeonato = new campeonato();
        $this->objJogaEm = new joga_em();
    }

    public function index()
    {
        $campeonatos = DB::table('campeonatos')
                ->where('Eexcluido', '=', '0')
                ->orderBy('created_at', 'DESC')
                ->orderBy('nome', 'ASC')
                ->get();
        return view('campeonatos/index', compact('campeonatos'));
    }

    public function cadastrarCampeonato()
    {
        return view('campeonatos/cadastrar');
    }

    public function pesquisar($formato)
    {
        dd($formato);
        die();
    }

    public function show($id)
    {
        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatos($id);

        $modelTimesParticipantes = new timesParticipantes();
        $numeroTimes = $modelTimesParticipantes->lstQtdTimesParticipantes($id);

        $times = $modelTimesParticipantes->lstTimesParticipantes($id);

        $modelJogadoresParticipantes = new jogadoresParticipantes();
        $aux[] = $modelJogadoresParticipantes->lstQtdeJogadoresCampeonato($id);
        $numeroJogadores = array_column($aux[0],'total', 'id_time');
        
        return view(
            'campeonatos/exibir', 
            compact(
                'campeonato',
                'times',
                'numeroJogadores',
                'numeroTimes'
            ));
    }
    
    public function store(CampeonatosRequest $request)
    {
        $cadastro=$this->objCampeonato->create([
        'nome'=>$request->inNomeCampeonato,
        'formato'=>$request->slFormato,
        'Eexcluido' => 0,
        'numeroTimes' => $request->inNumeroTimes,
        'dataInicio'=>$request->inDataInicio,
        'dataFim'=>$request->inDataFim
        ]);
        if($cadastro){
            session()->flash('mensagem', 'Campeonato criado com sucesso!');
            return redirect('campeonato');
        }
        
    }

    public function edit($id)
    {
        $campeonato = $this->objCampeonato->find($id);
        return view('campeonatos/cadastrar', compact('campeonato'));
    }

    public function update(CampeonatosRequest $request, $id)
    {
        $this->objCampeonato->where(['id'=>$id])->update([
            'nome'=>$request->inNomeCampeonato,
            'formato'=>$request->slFormato,
            'Eexcluido' => 0,
            'numeroTimes' => $request->inNumeroTimes,
            'dataInicio'=>$request->inDataInicio,
            'dataFim'=>$request->inDataFim
        ]);
        session()->flash('mensagem', "Campeonato $request->inNomeCampeonato foi editado!");
        return redirect('campeonato');
    }

    public function deletarCampeonato(Request $request)
    {
        $modelCampeonato = new campeonato();
        $modelCampeonato->delCampeonato($request->hdCampeonato);
        
        session()->flash('mensagem', "Campeonato $request->hdCampeonato foi excluido!");
        return redirect('campeonato');
    }

    public function adicionarTime($idCampeonato)
    {
        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatos($idCampeonato);

        $modelTime = new time();
        $todosTimes = $modelTime->sltTimes();

        $modelTimesParticipantes = new timesParticipantes();
        $participantes = $modelTimesParticipantes->lstTimesParticipantes($idCampeonato);

        foreach($todosTimes as $time){
            if(!in_array($time, $participantes)){
                $times[] = $time;
            }
        }

        return view('campeonatos/adicionarTime', compact('campeonato', 'times'));
    }

    public function buscaJogadores(Request $request)
    {
        $idCampeonato = $request->hdCampeonato;
        $idTime = $request->slTime;
        $apagarDados = $request->hdApagarDados;

        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatos($idCampeonato);
        $campeonato = array($campeonato[0]);

        $modelTime = new time();
        $time = $modelTime->lstTimes(array($idTime));

        $modelJogaEm = new joga_em();
        $jogadores = $modelJogaEm->lstJogadoresPorTime($idTime);
        return view(
            'campeonatos/confirmarJogadores', 
            compact(
                'campeonato',
                'time', 
                'jogadores',
                'apagarDados'
            ));
    }

    public function salvaTimesJogadoresCampeonato(TimesJogadoresRequest $request)
    {
        $modelJogadoresParticipantes = new jogadoresParticipantes();
        $modelTimesParticipantes = new timesParticipantes();
        //apagar os jogadores do time
        if($request->hdApagarDados == 1){
            $modelJogadoresParticipantes->delJogadoresParticipantesPorTime(
                $request->hdTime, 
                $request->hdCampeonato
            );
            $modelTimesParticipantes->delTimesParticipantes($request->hdTime);
        }

        $dados = $modelJogadoresParticipantes->lstDadosJogadoresCampeonato($request->hdCampeonato);
        for($i = 0; $i < count($dados); $i++){
            $arrayJogadores[] = $dados[$i]['id_jogador'];
        }
        $arrayJogadores = !empty($arrayJogadores) ? $arrayJogadores : array(null);

         //verifica se os jogadores selecionados ja participam do campeonato
         $intersecao = array_intersect($request->ckJogador, $arrayJogadores);
         if(!is_null($intersecao)){
            $modelJogadores = new jogador();
            $jogadores = $modelJogadores->lstJogadores($intersecao);

            foreach($jogadores as $jogador){
                $arrayNomes[] = $jogador['nome']; 
            }
            session()->flash('mensagem', "O(s) jogador(es): " . implode(', ',$arrayNomes) . 
            " já estão participando deste campeonato!");
                return redirect("campeonato/$request->hdCampeonato");
         }

        //Insere os jogadores no campeonato
        foreach($request->ckJogador as $idJogador){
            /*if(in_array($idJogador, $arrayJogadores)){
                
               }*/
            $modelJogadoresParticipantes->insParticipantes(
                $request->hdCampeonato,
                $request->hdTime,
                intval($idJogador)
            );
        }

        //insere o time ao campeonato
        $cadastro = $modelTimesParticipantes->insParticipantes(
            $request->hdCampeonato,
            $request->hdTime
        );
        if($cadastro){
            session()->flash('mensagem', 'Time adicionado ao campeonato com sucesso!');
            return redirect("campeonato/$request->hdCampeonato");
        }
    }

    public function apagaTimesCampeonato(Request $request)
    {
        $modelTimesParticipantes = new timesParticipantes();
        $modelJogadoresParticipantes = new jogadoresParticipantes();

        $modelTimesParticipantes->delTimesParticipantes($request->slTime);
        $modelJogadoresParticipantes->delJogadoresParticipantesPorTime(
            $request->slTime,
            $request->hdCampeonato
        );

        session()->flash('mensagem', 'Time excluido do campeonato com sucesso!');
            return redirect("campeonato/$request->hdCampeonato");
    }
}

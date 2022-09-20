<?php

namespace App\Http\Controllers;


use App\Models\campeonato;
use App\Models\usuario;
use App\Models\time;
use App\Models\timesParticipantes;
use Illuminate\Http\Request;
use App\Http\Requests\CampeonatosRequest;
use App\Http\Requests\PartidasRequest;
use App\Http\Requests\TimesJogadoresRequest;
use App\Models\joga_em;
use App\Models\jogador;
use App\Models\jogadoresParticipantes;
use App\Models\local;
use App\Models\partida;
use Illuminate\Support\Facades\Redirect;

class CampeonatosController extends Controller
{
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
        if (session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
        }
        $modelCampeonato = new campeonato();
        $campeonatos = $modelCampeonato->lstCampeonatos();
        
        $modelTime = new time();
        $times = $modelTime->sltTimes();
        return view('campeonatos/index', compact('campeonatos', 'times'));
    }

    public function cadastrarCampeonato()
    {
        return view('campeonatos/cadastrar');
    }

    public function pesquisar(Request $request)
    {
        $formato = $request->slFormato == 'Selecione...' ? null : $request->slFormato;
        $slTime = $request->slTime == 'Selecione...' ? null : $request->slTime;
        $dtInicio = $request->inDataInicio == null ? null : $request->inDataInicio;
        $dtFim = $request->inDataFim == null ? null : $request->inDataFim;

        $modelTime = new time();
        $times = $modelTime->sltTimes();

        $modelCampeonato = new campeonato();
        $campeonatos = $modelCampeonato->lstCampeonatos();

        $aux1 = [];
        $aux2 = [];
        $aux3 = [];
        if(
            (!is_null($request->inDataInicio) && is_null($request->inDataFim)) 
            || (is_null($request->inDataInicio) && !is_null($request->inDataFim))
        ){
            session()->flash('mensagem', 'Informe uma data de inicio e de fim para a pesquisa.');
            return view('campeonatos/index', compact('campeonatos', 'times', 'formato', 'slTime', 'dtInicio', 'dtFim'));
        }
        if(!is_null($formato)){
            $aux1 = $modelCampeonato->lstCampeonatosPorFormato($formato);
        }

        if(!is_null($slTime)){
            $aux2 = $modelCampeonato->lstCampeonatosPorTime($slTime);
        }

        if(!is_null($request->inDataInicio) && !is_null($request->inDataFim)){
            $aux3 = $modelCampeonato->lstCampeonatosPorPeriodo($request->inDataInicio, $request->inDataFim);
        }

        for($i = 0; $i < count($aux1); $i++){
            $a1[] = $aux1[$i]['id'];
        }
        $a1 = !empty($a1) ? $a1 : array();

        foreach($aux2 as $val){
            $a2[] = $val['id'];
        }
        $a2 = !empty($a2) ? $a2 : array();

        for($i = 0; $i < count($aux3); $i++){
            $a3[] = $aux3[$i]['id'];
        }
        $a3 = !empty($a3) ? $a3 : array();

        if(empty($formato) && empty($slTime) && empty($request->inDataInicio) && empty($request->inDataFim)){
            return view('campeonatos/index', compact('campeonatos', 'times', 'formato', 'slTime', 'dtInicio', 'dtFim'));
        }else{
            //dd($a1, $a2, $a3);
            $array[] = $a1;
            $array[] = $a2;
            $array[] = $a3;

            $array = array_filter($array);
            //dd($array);
            if(!empty($array)){
                $arrayId = (array_intersect(...$array));
                $campeonatos = $modelCampeonato->lstCampeonatosPorId($arrayId);
            }else{
                $campeonatos = array();
            }
            return view('campeonatos/index', compact('campeonatos', 'times', 'formato', 'slTime', 'dtInicio', 'dtFim'));
        }
    }

    public function show($id)
    {
        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatosPorId(array($id));

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
            )
        );
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
        $campeonato = $modelCampeonato->lstCampeonatosPorId(array($idCampeonato));

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
        $campeonato = $modelCampeonato->lstCampeonatosPorId(array($idCampeonato));
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
       // dd($intersecao); 
        $arrayNomes = [];
        if(!empty($intersecao)){
            $modelJogadores = new jogador();
            $jogadores = $modelJogadores->lstJogadores($intersecao);

            foreach($jogadores as $jogador){
                $arrayNomes[] = $jogador['nome']; 
            }
            session()->flash('mensagem', "O(s) jogador(es): " . implode(', ',$arrayNomes) . 
            " já estão participando deste campeonato!");
                return redirect("campeonato/$request->hdCampeonato");
        }else{
            //Insere os jogadores no campeonato
            foreach($request->ckJogador as $idJogador){
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

    public function partidas($idCampeonato)
    {
        $modelPartida = new partida();
        $partidas = $modelPartida->lstPartidasPorIdCampeonato($idCampeonato);
        return view('campeonatos.partidas', compact('partidas'));
    }

    public function criarPartida($idCampeonato)
    {
        $modelTimes = new timesParticipantes();
        $times = $modelTimes->lstTimesParticipantes(array($idCampeonato));
        
        $modelLocal = new local();
        $locais = $modelLocal->lstLocais();
        
        return view('campeonatos.criaPartidas', compact('idCampeonato','times', 'locais'));
    }

    public function editarPartida($idPartida)
    {
        $modelPartida = new partida();
        $partida = $modelPartida->lstPartida($idPartida);
        //dd($partida);
        $modelTimes = new timesParticipantes();
        $times = $modelTimes->lstTimesParticipantes(array($partida[0]['id_campeonato']));
        
        $modelLocal = new local();
        $locais = $modelLocal->lstLocais();
        
        $dados['slTimeCasa'] = $partida[0]['id_time_casa'];
        $dados['slTimeVizitante'] = $partida[0]['id_time_visitante'];
        $dados['slLocal'] = $partida[0]['id_local'];
        $dados['inData'] = $partida[0]['dataHora'];
       // $dados['inHora'] = $partida[0]['inHora'];
       $idCampeonato = $partida[0]['id_campeonato'];

        return view('campeonatos.criaPartidas', compact('idCampeonato','times', 'locais', 'dados'));
    }

    public function salvaPartida(PartidasRequest $request)
    {
        $idCampeonato = $request['hdIdCampeonato'];
        $dados['slTimeCasa'] = $request['slTimeCasa'];
        $dados['slTimeVizitante'] = $request['slTimeVizitante'];
        $dados['slLocal'] = $request['slLocal'];
        $dados['inData'] = $request['inData'];
        $dados['inHora'] = $request['inHora'];

        if($request['slTimeCasa'] == $request['slTimeVizitante']){
            $modelTimes = new timesParticipantes();
            $times = $modelTimes->lstTimesParticipantes(array($idCampeonato));
        
            $modelLocal = new local();
            $locais = $modelLocal->lstLocais();

            session()->flash('mensagem', 'Os times selecionados não podem ser os mesmos!');
            return view('campeonatos.criaPartidas', compact('idCampeonato','times', 'locais', 'dados'));
        }else{
            $modelPartida = new partida();
            $modelPartida->insPartida(
                $request['hdIdCampeonato'],
                $request['slTimeCasa'],
                $request['slTimeVizitante'],
                $request['slLocal'],
                $request['inData'],
                $request['inHora'],
            );

            return Redirect($this->partidas($idCampeonato));
            //return Redirect::route('campeonato.partidas', ['idCampeonato' => $idCampeonato]);
            //return view('campeonatoS.partidas', compact('idCampeonato'));
        }
    }

    public function excluirPartida($idPartida)
    {
        $modelPartida = new partida();
        $modelPartida->delPartida($idPartida);

        session()->flash('mensagem', "Partida excluida com sucesso!");
        //return redirect('par');
        return view('campeonato.partidas', compact('idCampeonato'));
    }
}

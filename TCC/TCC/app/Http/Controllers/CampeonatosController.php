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
use App\Models\acao;
use App\Models\sumula;
use App\Rules\ValidaHora;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Auth;

class CampeonatosController extends Controller
{
    private $objCampeonato;

    public function __construct()
    {
        $this->objUsuario = new usuario();
        $this->objTime = new time();
        $this->objCampeonato = new campeonato();
        $this->objJogaEm = new joga_em();


        $this->middleware('auth');
        $this->middleware(['role:AdminCampeonato']);
    }

    public function index()
    {
        //var_dump(Auth::user()->name); die();
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
            $array[] = $a1;
            $array[] = $a2;
            $array[] = $a3;

            $array = array_filter($array);
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
        
        $arrayId = array_column($times, 'id');
        $modelPartida = new partida();

        $tabela = null;
        if ($campeonato[0]['formato'] == 'PC') {
            foreach ($times as $time) {
                $vitoriasEmCasa = $modelPartida->lstVitorias($time, $campeonato[0]['id']);
                $vitoriasFora = $modelPartida->lstVitorias($time, $campeonato[0]['id'], false);

                $empatesEmCasa = $modelPartida->lstVitorias($time, $campeonato[0]['id'], true, true);
                $empatesFora = $modelPartida->lstVitorias($time, $campeonato[0]['id'], false, true);
                
                $vitorias = $vitoriasEmCasa + $vitoriasFora;
                $empates = $empatesEmCasa + $empatesFora;

                $numeroPartidasCasa = $modelPartida->lstNumeroPartidas($time, $campeonato[0]['id']);
                $numeroPartidasVisitante = $modelPartida->lstNumeroPartidas($time, $campeonato[0]['id'], false);
                $numeroPartidas = $numeroPartidasCasa + $numeroPartidasVisitante;

                $tabela[$time['id']] = [
                    'pontos' => $vitorias * 3 + $empates,
                    'partidas' => $numeroPartidas,
                    'vitorias' => $vitorias,
                    'empates' => $empates,
                    'derrotas' => $numeroPartidas - ($vitorias + $empates)
                ];
            }
        }

        $modelPartida = new partida();
        $ultimasPartidas = $modelPartida->lstUltimasPartidas($campeonato[0]['id']);
        $proximasPartidas = $modelPartida->lstProximasPartidas($campeonato[0]['id']);

        return view(
            'campeonatos/exibir',
            compact(
                'campeonato',
                'times',
                'numeroJogadores',
                'numeroTimes',
                'tabela',
                'ultimasPartidas',
                'proximasPartidas'
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

        $modelJogadoresParticipantes = new jogadoresParticipantes();
        $participantes = array_column(
            $modelJogadoresParticipantes->lstDadosJogadoresCampeonato($request->hdCampeonato),
            'id_jogador'
        );

        $jogaTime = array_column(
            $modelJogadoresParticipantes->lstDadosJogadoresCampeonatoTime($request->hdCampeonato, $time),
            'id_jogador'
        );

        return view(
            'campeonatos/confirmarJogadores',
            compact(
                'campeonato',
                'time',
                'jogadores',
                'apagarDados',
                'participantes',
                'jogaTime'
            ));
    }

    public function salvaTimesJogadoresCampeonato(TimesJogadoresRequest $request)
    {
        $modelJogaEm = new joga_em();
        $jogadoresTime = $modelJogaEm->lstJogadoresPorTime($request->hdTime);

       $modelJogadoresParticipantes = new jogadoresParticipantes();
       
       //Verifica se o jogador já esta participando do campeonato por outro time
        $jogadoresParticipantes = array_column(
            $modelJogadoresParticipantes->lstDadosJogadoresCampeonatoTime(
                $request->hdCampeonato,
                $request->hdTime,
                '!='
            ),
            'id_jogador'
        );
        $jogadoresParticipantes = !empty($jogadoresParticipantes) ? $jogadoresParticipantes : array(null);
        
        $intersecao = array_intersect($request->ckJogador, $jogadoresParticipantes);
        
        $arrayNomes = [];
        if (!empty($intersecao)) {
            $modelJogadores = new jogador();
            $jogadores = $modelJogadores->lstJogadores($intersecao);

            foreach ($jogadores as $jogador) {
                $arrayNomes[] = $jogador['nome'];
            }
            session()->flash(
                'mensagem',
                "O(s) jogador(es): " . implode(', ', $arrayNomes) ." já estão participando deste campeonato!"
            );
            return redirect("campeonato/$request->hdCampeonato");
        }

        //Caso já exista registro pra o time atualiza os jogadores participantes
        if ($request->hdApagarDados === '1') {
            $jogadoresTime = $modelJogadoresParticipantes->lstJogadoresPorTimeECampeonato(
                $request->hdTime,
                $request->hdCampeonato
            );
            foreach ($jogadoresTime as $jogador) {
                $status = in_array($jogador['id_jogador'], $request->ckJogador) ? 1 : 0;
                $modelJogadoresParticipantes->updParticipantes(
                    intval($jogador['id']),
                    $status
                );
            }
            session()->flash('mensagem', 'Jogadores alterados com sucesso!');
            return redirect("campeonato/$request->hdCampeonato");
        }

        //Adiciona todos os jogadores ao time com o status correto
        foreach ($jogadoresTime as $jogador) {
            $status = in_array($jogador['id'], $request->ckJogador) ? 1 : 0;
            $modelJogadoresParticipantes->insParticipantes(
                $request->hdCampeonato,
                $request->hdTime,
                intval($jogador['id']),
                $status
            );
        }

        //insere o time ao campeonato
        $modelTimesParticipantes = new timesParticipantes();
        $cadastro = $modelTimesParticipantes->insParticipantes(
            $request->hdCampeonato,
            $request->hdTime
        );
        if ($cadastro) {
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

    public function partidas($idCampeonato)
    {
        $modelPartida = new partida();
        $partidas = $modelPartida->lstPartidasPorIdCampeonato($idCampeonato);
        return view('campeonatos.partidas', compact('idCampeonato', 'partidas'));
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
        
        $modelTimes = new timesParticipantes();
        $times = $modelTimes->lstTimesParticipantes(array($partida[0]['id_campeonato']));
        
        $modelLocal = new local();
        $locais = $modelLocal->lstLocais();
        
        $dados['slTimeCasa'] = $partida[0]['id_time_casa'];
        $dados['slTimeVizitante'] = $partida[0]['id_time_visitante'];
        $dados['slLocal'] = $partida[0]['id_local'];
        $dados['inData'] =  (new Carbon($partida[0]['dataHora']))->format('Y-m-d');
        $dados['inHora'] =  (new Carbon($partida[0]['dataHora']))->format('H:i:s');
        $idCampeonato = $partida[0]['id_campeonato'];

        return view('campeonatos.criaPartidas', compact('idCampeonato','times', 'locais', 'dados', 'partida'));
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
            $this->validate($request, ['inHora' => new ValidaHora]);
            $dataHora = $this->trataDataHora($request['inData'], $request['inHora']);

            $modelPartida = new partida();

            $modelPartida->insPartida(
                $request['hdIdCampeonato'],
                $request['slTimeCasa'],
                $request['slTimeVizitante'],
                $request['slLocal'],
                $dataHora
            );

            return Redirect("campeonato/$idCampeonato/partidas");
        }
    }

    public function excluirPartida($idPartida)
    {
        $modelPartida = new partida();
        $campeonato = $modelPartida->lstCampeonatoPorPartida($idPartida);
        $idCampeonato = $campeonato[0]['id_campeonato'];
        $partidas = $modelPartida->lstPartidasPorIdCampeonato($idCampeonato);
        $modelPartida->delPartida($idPartida);

        session()->flash('mensagem', "Partida excluida com sucesso!");
        
        return Redirect("campeonato/$idCampeonato/partidas");
        //return view('campeonatos.partidas', compact('idCampeonato', 'partidas'));
    }

    public function editaPartida(PartidasRequest $request, $idPartida)
    {

        $idCampeonato = $request['hdIdCampeonato'];
        $idCampeonato = $request['hdIdCampeonato'];
        $dados['slTimeCasa'] = $request['slTimeCasa'];
        $dados['slTimeVizitante'] = $request['slTimeVizitante'];
        $dados['slLocal'] = $request['slLocal'];
        $dados['inData'] = $request['inData'];
        $dados['inHora'] = $request['inHora'];

        $modelPartida = new partida();
        $partida = $modelPartida->lstPartida($idPartida);

        if ($request['slTimeCasa'] == $request['slTimeVizitante']) {
            $modelTimes = new timesParticipantes();
            $times = $modelTimes->lstTimesParticipantes(array($idCampeonato));
        
            $modelLocal = new local();
            $locais = $modelLocal->lstLocais();

            session()->flash('mensagem', 'Os times selecionados não podem ser os mesmos!');
            return view('campeonatos.criaPartidas', compact('idCampeonato','times', 'locais', 'dados', 'partida'));
        } else {
            $this->validate($request, ['inHora' => new ValidaHora]);
            $dataHora = $this->trataDataHora($request['inData'], $request['inHora']);
            
            $modelPartida->updPartida(
                $idPartida,
                $request->slTimeCasa,
                $request->slTimeVizitante,
                $request->slLocal,
                $dataHora
            );

            return Redirect("campeonato/$idCampeonato/partidas");
        }
    }

    public function encerraPartida($idPartida)
    {
        $modelAcao = new acao();
        $acoes = $modelAcao->lstAcao();
        
        $modelPartida = new partida();
        $timesParticipantes = $modelPartida->lstPartida($idPartida);

        $modelTime =  new time();
        $timesCasa = $modelTime->lstTimes([
            $timesParticipantes[0]['id_time_casa']
        ]);
        $timesVisitante = $modelTime->lstTimes([
            $timesParticipantes[0]['id_time_visitante']
        ]);
        $times = array_merge($timesCasa, $timesVisitante);

        return view('campeonatos.encerraPartida', compact('idPartida', 'acoes','times'));
    }

    public function validaEncerrarPartida(Request $request)
    {
        $count = ((count($request->query())) - 4) / 3;

        $modelSumula = new sumula();

        $golsTimeCasa = 0;
        $golsTimeVisitante = 0;

        for($i=0; $i<$count; $i++){
            $modelSumula->insAcao(
                $request['hdPartida'],
                $request['slAcao'.$i],
                $request['slTime'.$i],
                $request['inTempo'.$i]
            );
            
            if($request['slAcao'.$i] == 1 && $request['slTime'.$i] == $request['hdTimeCasa']
            || $request['slAcao'.$i] == 2 && $request['slTime'.$i] == $request['hdTimeVisitante']
            ){
                $golsTimeCasa++;
            }

            if($request['slAcao'.$i] == 1 && $request['slTime'.$i] == $request['hdTimeVisitante']
            || $request['slAcao'.$i] == 2 && $request['slTime'.$i] == $request['hdTimeCasa']
            ){
                $golsTimeVisitante++;
            }
        }
        $modelPartida = new partida();
        $modelPartida->encerraPartida($request['hdPartida'], $golsTimeCasa, $golsTimeVisitante);

        $campeonato = $modelPartida->lstCampeonatoPorPartida($request['hdPartida']);
        $idCampeonato = intval($campeonato[0]);

        $partidas = $modelPartida->lstPartidasPorIdCampeonato($campeonato);
        
        return view('campeonatos.partidas', compact('idCampeonato','partidas'));
    }

    public function detalhesPartida($idPartida)
    {
        $modelPartida = new partida();
        $partida = $modelPartida->lstDadosPartidaPorIdPartida($idPartida);

        $modelSumula = new sumula();
        $eventos = $modelSumula->lstEventosPorPartida($idPartida);

        return view('campeonatos.detalhesPartida', compact('partida', 'eventos'));
    }

    public function editarResultado($idPartida)
    {
        $modelSumula = new sumula();
        $eventos =  $modelSumula->lstEventosPorPartida($idPartida);
        
        $modelPartida = new partida();
        $modelTime =  new time();
        $timesParticipantes = $modelPartida->lstPartida($idPartida);
        $times = $modelTime->lstTimes([
            $timesParticipantes[0]['id_time_casa'],
            $timesParticipantes[0]['id_time_visitante']
        ]);

        $modelAcao = new acao();
        $acoes = $modelAcao->lstAcao();
        
        return view('campeonatos.editaResultado', compact('idPartida', 'eventos', 'times', 'acoes'));
    }

    public function validaAlterarResultado(Request $request)
    {
        $modelSumula = new sumula();
        $eventos =  $modelSumula->lstEventosPorPartida($request['hdPartida']);

        $arrayEventos = array_column($eventos, 'idAcao');
        
        $aux = 0;
        $golsTimeCasa = 0;
        $golsTimeVisitante = 0;

        $modelSumula = new sumula();
        for ($i=0; $i<count($eventos); $i++) {
            if (in_array($request['hdidSumula'.$i], $arrayEventos)) {
                //atualiza ocorrencia na sumula
                $modelSumula->updOcorrencia(
                    $request['hdidSumula'.$i],
                    $request['slAcaoExistente'.$i],
                    $request['slTimeExistente'.$i],
                    $request['inTempoExistente'.$i]
                );
                $aux++;
            } else {
                //remove ocorrencia da sumula
                $modelSumula->excluiOcorrencia($arrayEventos[$i]);
            }
        }

        $count = ((count($request->query())) - 4 - (4 * $aux)) / 3;

        for($i=1; $i<=$count; $i++){
            $modelSumula->insAcao(
                $request['hdPartida'],
                $request['slAcao'.$i],
                $request['slTime'.$i],
                $request['inTempo'.$i]
            );
        }
        $sumula = $modelSumula->lstEventosPorPartida($request['hdPartida']);

        foreach($sumula as $valor){
            if($valor['id_acao'] == 1 && $valor['id_time'] == $request['hdTimeCasa']
            || $request['id_acao'] == 2 && $request['id_time'] == $request['hdTimeVisitante']
            ){
                $golsTimeCasa++;
            }

            if($valor['id_acao'] == 1 && $valor['id_time'] == $request['hdTimeVisitante']
            || $valor['id_acao'] == 2 && $valor['id_time'] == $request['hdTimeCasa']
            ){
                $golsTimeVisitante++;
            }
        }

        $modelPartida = new partida();
        $modelPartida->atualizaResultado($request['hdPartida'], $golsTimeCasa, $golsTimeVisitante);

        $campeonato = $modelPartida->lstCampeonatoPorPartida($request['hdPartida']);
        $idCampeonato = intval($campeonato[0]);

        $partidas = $modelPartida->lstPartidasPorIdCampeonato($campeonato);
        
        return view('campeonatos.partidas', compact('idCampeonato','partidas'));
    }

    public function trataDataHora($stringData, $stringHora)
    {
        $ano = substr($stringData, 0, 4);
        $mes = substr($stringData, 5, 2);
        $dia = substr($stringData, 8, 2);
        $hora = substr($stringHora, 0, 2);
        $minuto = substr($stringHora, 3, 2);
        $segundo = substr($stringHora, 6, 2);
        return Carbon::create($ano, $mes, $dia, $hora, $minuto, $segundo, -2);
    }
}

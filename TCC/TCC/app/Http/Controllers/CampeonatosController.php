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
use App\Models\Grupos;
use App\Models\TimeParticipaGrupo;
use App\Models\arbritos;
use App\Models\Arquivo;
use App\Rules\ValidaHora;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Auth;
//use Dompdf\Dompdf;
//use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Stroage;

class CampeonatosController extends Controller
{
    private $objCampeonato;

    public function __construct()
    {
        $this->objUsuario = new usuario();
        $this->objTime = new time();
        $this->objCampeonato = new campeonato();
        $this->objJogaEm = new joga_em();

        //  $this->middleware('auth');
        //$this->middleware(['role:AdminCampeonato']);
        
        $this->middleware(['role:AdminCampeonato|AdminGeral'])
            ->except('index', 'pesquisar', 'show', 'partidas', 'detalhesPartida');
    }

    public function index()
    {   
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

        $tabela = $arrayTimes = $grupos = $tabelaGrupos = $nomeGrupo = null;
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
                    'time' => $time['id'],
                    'pontos' => $vitorias * 3 + $empates,
                    'partidas' => $numeroPartidas,
                    'vitorias' => $vitorias,
                    'empates' => $empates,
                    'derrotas' => $numeroPartidas - ($vitorias + $empates)
                ];
            }
            if (!is_null($tabela)) {
                array_multisort(array_column($tabela, "pontos"), SORT_DESC, $tabela);
                $arrayTimes = array_column($times, 'nome', 'id');
            }
        }

        if ($campeonato[0]['formato'] == 'CP') {
            $modelGrupos = new Grupos();
            $grupos = $modelGrupos->lstGruposPorIdCampeonato($id);
            $arrayGrupo = array_column($grupos, 'id');
            $nomeGrupo = array_column($grupos, 'nome', 'id');
            //dd($grupos, $arrayGrupo, $nomeGrupo);

            foreach ($arrayGrupo as $grupo) {
                $times = null;
                $tabelaGP = null;
                $modelTimeParticipaGrupo = new TimeParticipaGrupo();
                $times = $modelTimeParticipaGrupo->lstTimesPorGrupo($grupo);
                foreach ($times as $time) {
                    $vitoriasEmCasa = $modelPartida->lstVitorias($time['id'], $campeonato[0]['id'], true, false, $grupo);
                    $vitoriasFora = $modelPartida->lstVitorias($time['id'], $campeonato[0]['id'], false, false, $grupo);

                    $empatesEmCasa = $modelPartida->lstVitorias($time['id'], $campeonato[0]['id'], true, true, $grupo);
                    $empatesFora = $modelPartida->lstVitorias($time['id'], $campeonato[0]['id'], false, true, $grupo);
                    
                    $vitorias = $vitoriasEmCasa + $vitoriasFora;
                    $empates = $empatesEmCasa + $empatesFora;

                    $numeroPartidasCasa = $modelPartida->lstNumeroPartidas($time['id'], $campeonato[0]['id'], true, $grupo);
                    $numeroPartidasVisitante = $modelPartida->lstNumeroPartidas($time['id'], $campeonato[0]['id'], false, $grupo);
                    $numeroPartidas = $numeroPartidasCasa + $numeroPartidasVisitante;

                    $tabelaGP[$time['id']] = [
                        'time' => $time['id'],
                        'pontos' => $vitorias * 3 + $empates,
                        'partidas' => $numeroPartidas,
                        'vitorias' => $vitorias,
                        'empates' => $empates,
                        'derrotas' => $numeroPartidas - ($vitorias + $empates)
                    ];
                }

                if (!is_null($tabelaGP)) {
                    array_multisort(array_column($tabelaGP, "pontos"), SORT_DESC, $tabelaGP);
                    $tabelaGrupos[$grupo] = $tabelaGP;
                    $arrayTimes[] = array_column($times, 'nome', 'id');
                }
            }
        }
        //dd($tabelaGrupos);

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
                'proximasPartidas',
                'arrayTimes',
                'grupos',
                'tabelaGrupos',
                'nomeGrupo'
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

        empty($todosTimes) ? $times = [] : null;
        
        foreach ($todosTimes as $time) {
            if (!in_array($time, $participantes)) {
                $times[] = $time;
            }
        }

        return view('campeonatos/adicionarTime', compact('campeonato', 'times'));
    }

    public function criarGrupo($idCampeonato)
    {
        return view('campeonatos/criarGrupo', compact('idCampeonato'));
    }

    public function salvarGrupo(Request $request, $idCampeonato)
    {
        $modelGrupos = new Grupos();
        $modelGrupos->inGrupo($request->inNome, $idCampeonato, $request->inNumeroTimes);

        session()->flash(
            'mensagem',
            "Grupo criado com sucesso!"
        );
        return redirect("campeonato/$request->hdCampeonato");
    }

    public function verGrupo($idGrupo)
    {
        $modelGrupo = new Grupos();
        $grupos = $modelGrupo->lstDadosGrupo($idGrupo);

        $modelTimeParticipaGrupo = new TimeParticipaGrupo();
        $times =  $modelTimeParticipaGrupo->lstTimesPorGrupo($idGrupo);

        $numeroTimes = $modelTimeParticipaGrupo->lstQtdTimesParticipantes($idGrupo);
        return view('campeonatos/verGrupo', compact('idGrupo', 'grupos', 'times', 'numeroTimes'));
    }

    public function apagarGrupo(Request $request)
    {
        $modelGrupo = new Grupos();
        $modelGrupo->delGrupo($request->hdIdGrupo);

        session()->flash('mensagem', 'Time excluido do grupo com sucesso!');
            return redirect("campeonato/$request->hdCampeonato");
    }

    public function apagaTimeGrupo(Request $request)
    {
        //dd($request);
        $modelTimeParticipaGrupo = new TimeParticipaGrupo();
        $modelTimeParticipaGrupo->delTimeGrupo($request->slTime, $request->hdGrupo);

        session()->flash('mensagem', 'Time excluido do grupo com sucesso!');
            return redirect("campeonato/$request->hdCampeonato");
    }

    public function adicionarTimeGrupo($idGrupo)
    {
        $modelGrupo = new Grupos();
        $grupo =  $modelGrupo->lstDadosGrupo($idGrupo);
        
        $campeonato = $grupo[0]['id_campeonato'];
        
        $modelTimesParticipantes = new timesParticipantes();
        $todosTimes = $modelTimesParticipantes->lstTimesParticipantes($campeonato);

        $modelTimesParticipaGrupo = new TimeParticipaGrupo();
        $arrayTimesParticipantes = $modelTimesParticipaGrupo->lstTimesPorGrupo($idGrupo);
        $participantes = array_column($arrayTimesParticipantes, 'id_time');

        empty($todosTimes) ? $times = [] : null;
        
        foreach ($todosTimes as $time) {
            if (!in_array($time['id'], $participantes)) {
                $times[] = $time;
            }
        }
        //dd($todosTimes, $participantes);
        return view('campeonatos/adicionarTimeGrupo', compact('grupo', 'times'));
    }

    public function validaSalvaTimeGrupo(Request $request)
    {
        $idGrupo = $request->hdGrupo;
        $idTime = $request->slTime;
        //dd($idGrupo, $idTime);
        if ($idTime == 0) {
            session()->flash(
                'mensagem',
                "Selecione um time!"
            );
            return redirect()->route('campeonato.adicionarTimeGrupo', ['idGrupo' => $idGrupo]);
        }
        $modelTimeParticipaGrupo = new TimeParticipaGrupo();
        $modelTimeParticipaGrupo->inTime($idGrupo, $idTime);

        session()->flash(
            'mensagem',
            "Time adicionado com sucesso!"
        );
        return redirect()->route('campeonato.adicionarTimeGrupo', ['idGrupo' => $idGrupo]);
    }

    public function buscaJogadores(Request $request)
    {
        $idCampeonato = $request->hdCampeonato;
        $idTime = $request->slTime;
        $apagarDados = $request->hdApagarDados;
        if ($idTime == 0) {
            session()->flash(
                'mensagem',
                "Selecione um time!"
            );
            return redirect()->route('campeonato.adicionarTime', ['idCampeonato' => $idCampeonato]);
        }
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

        //verifica se o time participa de alguma partida
        //em caso positivo nao permite excluir o time do campeonato

        $modelPartida = new partida();
        $participaCampeonato = $modelPartida->lstPartidasPorIdCampeonatoIdTime(
            $request->hdCampeonato,
            $request->slTime,
        );

        if (!empty($participaCampeonato)) {
            session()->flash('mensagem', 'Não é possivel excluir o time do campeonato pois ele
                disputa partidas nesse campeonato. Exclua as partidas e tente novamente.');
            return redirect("campeonato/$request->hdCampeonato");
        }

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

        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatosPorId([$idCampeonato]);
        $formato = $campeonato[0]->formato;
        
        $modelPartida = new partida();
        $partidas = $modelPartida->lstPartidasPorIdCampeonato($idCampeonato);
        $numeroPartidas = count($partidas);

        $modelTimesParticipantes = new timesParticipantes();
        $times = $modelTimesParticipantes->lstTimesParticipantes($idCampeonato);
        $numeroTimes = count($times);

        $modelArquivo = new Arquivo();
        $arquivos = array_column(
            $modelArquivo->lstArquivos(array_column($partidas, 'id')),
            'id_partida',
            'arquivo',
        );

        return view(
            'campeonatos.partidas',
            compact('idCampeonato', 'partidas', 'formato', 'numeroPartidas', 'numeroTimes', 'arquivos')
        );
    }

    public function criarPartida($idCampeonato, $grupo = null)
    {
        $modelCampeonato = new campeonato();
        $dados = $modelCampeonato->lstCampeonatosPorId([$idCampeonato]);
        $formato = ($dados[0]->formato);

        if ($formato == 'CP' && is_null($grupo)) {
            $modelGrupo = new Grupos();
            $grupos = $modelGrupo->lstGruposPorIdCampeonato($idCampeonato);
            return view('campeonatos.selecionarGrupo', compact('idCampeonato', 'formato', 'grupos'));
        }

        if ($formato == 'CP') {
            $modelTimes = new TimeParticipaGrupo();
            $times = $modelTimes->lstTimesPorGrupo($grupo);

        } else {
            $modelTimes = new timesParticipantes();
            $times = $modelTimes->lstTimesParticipantes(array($idCampeonato));
        }
            
        $modelLocal = new local();
        $locais = $modelLocal->lstLocais();

        $modelArbrito = new arbritos();
        $arbritos = $modelArbrito->lstArbritos(0);
            
        return view(
            'campeonatos.criaPartidas',
            compact('idCampeonato', 'times', 'locais', 'formato', 'grupo', 'arbritos')
        );
    }

    public function editarPartida($idPartida, $grupo = null)
    {
        $modelPartida = new partida();
        $partida = $modelPartida->lstPartida($idPartida);
        
        $modelTimes = new timesParticipantes();
        $times = $modelTimes->lstTimesParticipantes(array($partida[0]['id_campeonato']));
        
        $modelLocal = new local();
        $locais = $modelLocal->lstLocais();

        $modelCampeonato = new campeonato();
        $dados = $modelCampeonato->lstCampeonatosPorId([$partida[0]['id_campeonato']]);
        $formato = ($dados[0]->formato);

        $modelArbrito = new arbritos();
        $arbritos = $modelArbrito->lstArbritos(0);

        $dados['slTimeCasa'] = $partida[0]['id_time_casa'];
        $dados['slTimeVizitante'] = $partida[0]['id_time_visitante'];
        $dados['slLocal'] = $partida[0]['id_local'];
        $dados['inData'] =  (new Carbon($partida[0]['dataHora']))->format('Y-m-d');
        $dados['inHora'] =  (new Carbon($partida[0]['dataHora']))->format('H:i:s');
        $dados['slArbrito'] = $partida[0]['id_arbrito'];
        $dados['slAuxiliar1'] = $partida[0]['id_auxiliar1'];
        $dados['slAuxiliar2'] = $partida[0]['id_auxiliar2'];
        $dados['slMesario'] = $partida[0]['id_mesario'];
        $idCampeonato = $partida[0]['id_campeonato'];
        return view(
            'campeonatos.criaPartidas',
            compact('idCampeonato', 'idPartida', 'times', 'locais', 'dados', 'partida',
                'arbritos', 'formato', 'grupo')
        );
    }

    public function salvaPartida(PartidasRequest $request)
    {
        
        $idCampeonato = $request['hdIdCampeonato'];
        $dados['slTimeCasa'] = $request['slTimeCasa'];
        $dados['slTimeVizitante'] = $request['slTimeVizitante'];
        $dados['slLocal'] = $request['slLocal'];
        $dados['inData'] = $request['inData'];
        $dados['inHora'] = $request['inHora'];
        $dados['slArbrito'] = $request['slArbrito'];
        $dados['slAuxiliar1'] = $request['slAuxiliar1'];
        $dados['slAuxiliar2'] = $request['slAuxiliar2'];
        $dados['slMesario'] = $request['slMesario'];

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

            $partidas = array_column(
                $modelPartida->lstPartidasPorIdCampeonato($idCampeonato),
                'etapa'
            );
            $etapa = empty($partidas) ? 0 : max($partidas);

            $modelPartida->insPartida(
                $request['hdIdCampeonato'],
                $request['slTimeCasa'],
                $request['slTimeVizitante'],
                $request['slLocal'],
                $dataHora,
                $etapa,
                $request->hdGrupo,
                $request['slArbrito'],
                $request['slAuxiliar1'],
                $request['slAuxiliar2'],
                $request['slMesario'],
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

    public function editaPartida($idPartida, PartidasRequest $request)
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
                $dataHora,
                $request['slArbrito'],
                $request['slAuxiliar1'],
                $request['slAuxiliar2'],
                $request['slMesario']

            );

            return Redirect("campeonato/$idCampeonato/partidas");
        }
    }

    public function CriaPartidasGrupo(Request $request)
    {
        return redirect()->route('campeonato.criarPartida', [
            'idCampeonato' => $request->hdCampeonato,
            'idgrupo' => $request->slGrupo
        ]);
    }

    public function encerraPartida($idPartida)
    {
        $modelPartida = new partida();
        $dadosPartida = $modelPartida->lstPartida($idPartida);
        $modelTime =  new time();
        $timesCasa = $modelTime->lstTimes([
            $dadosPartida[0]['id_time_casa']
        ]);
        $timesVisitante = $modelTime->lstTimes([
            $dadosPartida[0]['id_time_visitante']
        ]);
        $times = array_merge($timesCasa, $timesVisitante);
//dd($times);
        return view('campeonatos.encerraPartida', compact('idPartida', 'times', 'dadosPartida'));
    }

    public function validaEncerrarPartida(Request $request)
    {
        $modelPartida = new partida();
        $modelPartida->encerraPartida(
            $request['hdPartida'],
            $request->inGolsTimeCasa,
            $request->inGolsTimeVisitante,
        );

        $campeonato = $modelPartida->lstCampeonatoPorPartida($request['hdPartida']);
        $idCampeonato = intval($campeonato[0]['id_campeonato']);

        return redirect()->route('campeonato.partidas', ['idCampeonato' => $idCampeonato]);
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
        $observacao = $timesParticipantes[0]['observacao'];

        $modelAcao = new acao();
        $acoes = $modelAcao->lstAcao();
        
        return view('campeonatos.encerraPartida', compact('idPartida', 'eventos', 'times', 'acoes', 'observacao'));
    }

    public function validaAlterarResultado(Request $request)
    {
        $modelPartida = new partida();
        $modelPartida->encerraPartida(
            $request['hdPartida'],
            $request->inGolsTimeCasa,
            $request->inGolsTimeVisitante,
        );

        $campeonato = $modelPartida->lstCampeonatoPorPartida($request['hdPartida']);
        $idCampeonato = intval($campeonato[0]['id_campeonato']);

        $partidas = $modelPartida->lstPartidasPorIdCampeonato($campeonato);
        
        return redirect()->route('campeonato.partidas', ['idCampeonato' => $idCampeonato]);
        //return view('campeonatos.partidas', compact('idCampeonato','partidas'));
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

    public function geraSumulaPdf($idPartida)
    {
        $modelPartida = new partida();
        $partida =  $modelPartida->lstDadosPartidaPorIdPartida($idPartida);

        $modelJogadoresParticipantes = new jogadoresParticipantes();
        $jogadoresTimeCasa = $modelJogadoresParticipantes->lstDadosJogadoresCampeonatoTime(
            $partida[0]['idCampeonato'],
            $partida[0]['idTimeCasa']
        );
        $jogadoresTimeVisitante = $modelJogadoresParticipantes->lstDadosJogadoresCampeonatoTime(
            $partida[0]['idCampeonato'],
            $partida[0]['idTimeVisitante']
        );
        $qtdeJogadores = count($jogadoresTimeCasa) >= count($jogadoresTimeVisitante)
            ? count($jogadoresTimeCasa)
            : count($jogadoresTimeVisitante);
        //dd($jogadoresTimeCasa, $jogadoresTimeVisitante);
        
        $pdf = PDF::loadView(
            'campeonatos.sumulaPDF',
            compact(
                'partida',
                'qtdeJogadores',
                'jogadoresTimeCasa',
                'jogadoresTimeVisitante'
            )
        );
        return $pdf->setPaper('A4')->stream('sumula.pdf');
    }

    /**
     * Redireciona para a tela que realiza o upload da sumula
     */
    public function upLoadArquivo($idPartida)
    {
        return view('campeonatos.uploadSumula', compact('idPartida'));
    }

    /**
     * Salva o arquivo no diretorio e cria o registro no banco de dados
     */
    public function validaEnviarSumula($idPartida, Request $request)
    {
        $data=new Arquivo();
		$file=$request->file;
        $filename=time().'.'.$file->getClientOriginalExtension();
        
        $destinationPath = base_path('public\sumulas');
        
        $request->file->move($destinationPath, $filename);
        $data->arquivo=$filename;
        
        $data->nome=$filename;
        $data->id_partida=$idPartida;

        $data->save();
		
        //voltar para tela que lista as partidas
        $modelPartida = new partida();
        $campeonato = $modelPartida->lstCampeonatoPorPartida($idPartida);
        $idCampeonato = intval($campeonato[0]['id_campeonato']);
        return redirect()->route('campeonato.partidas', ['idCampeonato' => $idCampeonato]);
    }

    /**
     * Realiza o donwload do arquvo da sumula enviada previamente
     */
    public function downloadArquivo($idPartida)
    {
        $modelArquivo = new Arquivo();
        $aux =  $modelArquivo->lstArquivos([$idPartida]);
        $arquivo = $aux[0]['arquivo'];
        return response()->download(public_path('sumulas/'.$arquivo));

    }

    /**
     * Remove o arquivo da sumula e exluio o registro do banco de dados
     */
    public function removerSumula($idPartida)
    {
        $modelArquivo = new Arquivo();
        $aux =  $modelArquivo->lstArquivos([$idPartida]);
        $arquivo = $aux[0]['arquivo'];
        unlink(public_path('sumulas/'.$arquivo));
        $modelArquivo->delArquivos([$idPartida]);

        //voltar para tela que lista as partidas
        $modelPartida = new partida();
        $campeonato = $modelPartida->lstCampeonatoPorPartida($idPartida);
        $idCampeonato = intval($campeonato[0]['id_campeonato']);
        return redirect()->route('campeonato.partidas', ['idCampeonato' => $idCampeonato]);
    }
}

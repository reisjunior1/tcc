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
use App\Rules\ValidaHora;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;

class MataMataController extends Controller
{

    public function __construct()
    {
        //  $this->middleware('auth');
        //$this->middleware(['role:AdminCampeonato']);
        $this->middleware(['role:AdminCampeonato'])
            ->except('index', 'verCampeonato', 'show', 'partidas', 'detalhesPartida');
    }

    public function index()
    {   
        $modelCampeonato = new campeonato();
        $campeonatos = $modelCampeonato->lstCampeonatos();
        
        $modelTime = new time();
        $times = $modelTime->sltTimes();
        return view('campeonatos/index', compact('campeonatos', 'times'));
    }

    public function verCampeonato()
    {
        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatosPorId([3]);

        $modelPartidas = new partida();
        $etapa = ($modelPartidas->getMaiorStatus(3))[0]['etapa'];

        for ($i = $etapa; $i > 0; $i--) {
            $partidas[$i] = $modelPartidas->lstPartidasPorIdCampeonatoEtapa(3, $i);
        }
    //dd($partidas);
        return view('campeonatos.chaveamento', compact('partidas'));
    }

    public function proximaEtapa()
    {
        $modelPartidas = new partida();
        $etapa = ($modelPartidas->getMaiorStatus(3))[0]['etapa'];

        $partidas = $modelPartidas->lstPartidasPorIdCampeonatoEtapa(3, $etapa);

        $arrayStatus = array_column($partidas, 'status');

        if (in_array(0, $arrayStatus)) {
            session()->flash('mensagem', 'Existem partidas não encerradas na etapa '.$etapa .'');
            return redirect()->route('campeonato.partidas', ['idCampeonato' => 3]);
        }

        $vencedores = $this->getVencedoresEtapaAnterior(3, $etapa);

        $proximaEtapa = $etapa + 1;
        $dataHora = new DateTime();
        //dd($dataHora);
        for ($i = 0; $i < count($vencedores); $i += 2) {
            $j = $i+1;
            $modelPartidas->insPartida(
                3,
                $vencedores[$i],
                $vencedores[$j],
                1,
                $dataHora,
                $proximaEtapa
            );
        }

        session()->flash('mensagem', 'As partidas da etapa foram criadas! <br>
            Atenção: Ainda é necessário alterar confirmar o horário e local da partida');
        return redirect()->route('campeonato.partidas', ['idCampeonato' => 3]);

    }

    private function getVencedoresEtapaAnterior($campeonato, $etapa)
    {
        $modelPartidas = new partida();
        $dados = $modelPartidas->lstVencedoresEtapa($campeonato, $etapa);

        $array = [];
        foreach ($dados as $value) {
            if ($value['gols_time_casa'] > $value['gols_time_visitante']) {
                $array[] = $value['timeCasa'];
            } elseif ($value['gols_time_casa'] < $value['gols_time_visitante']) {
                $array[] = $value['timeVisitante'];
            }
        }
        return $array;
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

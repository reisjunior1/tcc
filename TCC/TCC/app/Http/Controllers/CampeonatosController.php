<?php

namespace App\Http\Controllers;


use App\Models\campeonato;
use App\Models\usuario;
use App\Models\time;
use App\Models\timesParticipantes;
use Illuminate\Http\Request;
use App\Http\Requests\CampeonatosRequest;
use App\Models\joga_em;
use App\Models\jogador;
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
        $timesParticipantes = array_column($modelTimesParticipantes->lstParticipantes($id), 'id_time');

        $modelTime = new time();
        $times = $modelTime->lstTimes($timesParticipantes);

        return view('campeonatos/exibir', compact('campeonato','times'));
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

    public function destroy($id)
    {
        $del=$this->objBook->destroy($id);
        return($del)?"sim":"não";
    }

    public function adicionarTime($idCampeonato)
    {
        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatos($idCampeonato);

        $modelTime = new time();
        $times = $modelTime->sltTimes();

        return view('campeonatos/adicionarTime', compact('campeonato', 'times'));
    }

    public function buscaJogadores(Request $request)
    {
        $idCampeonato = $request->hdCampeonato;
        $idTime = $request->slTime;
        $modelCampeonato = new campeonato();
        $campeonato = $modelCampeonato->lstCampeonatos($idCampeonato);
        $campeonato = array($campeonato[0]);

        $modelTime = new time();
        $time = $modelTime->lstTimes(array($idTime));

        $modelJogaEm = new joga_em();
        $jogadores = $modelJogaEm->lstJogadoresPorTime($idTime);
        return view('campeonatos/confirmarJogadores', compact('campeonato','time', 'jogadores'));
    }

    public function salvaTimesJogadoresCampeonato(Request $request)
    {
        $modelTimesParticipantes = new timesParticipantes();
        $cadastro = $modelTimesParticipantes->insParticipantes(
            $request->hdCampeonato,
            $request->hdTime
        );
        if($cadastro){
            session()->flash('mensagem', 'Time adicionado ao campeonato com sucesso!');
            return redirect('campeonato');
        }
    }
}

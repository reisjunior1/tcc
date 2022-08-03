<?php

namespace App\Http\Controllers;

use App\Models\campeonato;
use App\Models\usuario;
use App\Models\time;
use Illuminate\Http\Request;
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
    }

    public function index()
    {
        //$campeonatos = $this->objCampeonato->all();
        $campeonatos = DB::table('campeonatos')
                ->where('Eexcluido', '=', '0')
                ->orderBy('created_at', 'DESC')
                ->orderBy('nome', 'ASC')
                ->get();
        return view('campeonatos/index', compact('campeonatos'));
    }
    public function cadastrarCampeonato()
    {
        $times = $this->objTime->all();
        return view('campeonatos/cadastrar', compact('times'));
    }

    public function pesquisar($formato)
    {
        dd($formato);
        die();
    }

    public function show($id)
    {
        $campeonato = $this->objCampeonato->find($id);
        return view('campeonatos/exibir', compact('campeonato'));
    }
    
    public function store(Request $request)
    {
        //dd($request->inNomeCampeonato);die();
        $cadastro=$this->objCampeonato->create([
        'nome'=>$request->inNomeCampeonato,
        'formato'=>$request->slFormato,
        'Eexcluido' => 0,
        'numeroTimes' => $request->inNumeroTimes,
        'dataInicio'=>$request->inDataInicio,
        'dataFim'=>$request->inDataFim
        ]);
        if($cadastro){
            return redirect('campeonato');
        }
}
}

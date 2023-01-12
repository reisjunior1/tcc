<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time;
use App\Http\Requests\TimeRequest;
use Auth;

class TimeController extends Controller
{
    private $objUsuario;
    private $objTime;
    

    public function __construct()
    {
        $this->objTime = new time();
        $this->middleware('auth');
        $this->middleware(['role:AdminTime']);
        
    }
    public function index()
    {
        $modelTime = new time();
        $times = $modelTime->lstTimesPorIdUsuario(Auth::user()->id);
        return view('times/index', compact('times'));
    }

    public function gerenciar($idTime)
    {
        //
    }

    public function cadastrar()
    {
        return view(view:'times.times');
    }

    public function store(Request $request)
    {
        //dd(intval(Auth::user()->id));
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
            'id_local'=>1
        ]);
        if($cadastro){
            return redirect('time');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\arbritos;
use App\Http\Requests\ArbritosRequest;
use Illuminate\Http\Request;
use Auth;

class ArbritoController extends Controller
{

    private $objArbrito;

    public function __construct()
    {
        $this->objArbrito = new arbritos();
        $this->middleware('auth');
        $this->middleware(['role:AdminTime|AdminGeral']);
        
    }

    public function index()
    {
        $modelArbrito = new arbritos();
        $arbritos = $modelArbrito->lstArbritos();
        return view('arbritos/index', compact('arbritos'));
    }

    public function cadastrar($id = null)
    {
        if (!is_null($id)) {
            $modelArbrito = new arbritos();
            $arbrito = $modelArbrito->lstArbritosPorId($id);
            return view('arbritos/cadastrar', compact('id', 'arbrito'));
        }
        return view('arbritos/cadastrar');
    }

    public function store(ArbritosRequest $request)
    {
        $cadastro=$this->objArbrito->create([
            'nome'=>$request->inNome,
            'cpf'=>$request->inCpf,
            'telefone'=>$request->inTelefone,
            'email'=>$request->inEmail,
            'Eexcluido'=>0
        ]);
        if ($cadastro) {
            return redirect()->route('arbrito.index');
        }
    }

    public function update(ArbritosRequest $request, $id)
    {
        $cadastro=$this->objArbrito->where(['id'=>$id])->update([
            'nome'=>$request->inNome,
            'cpf'=>$request->inCpf,
            'telefone'=>$request->inTelefone,
            'email'=>$request->inEmail,
            'Eexcluido'=>0
        ]);
        if ($cadastro) {
            return redirect()->route('arbrito.index');
        }
    }

    public function ativarDesativar($idLocal)
    {
        $modelArbrito = new arbritos();
        $arbrito = $modelArbrito->lstArbritosPorId([$idLocal]);
        //dd($local);
        $nome = $arbrito[0]['nome'];
        if ($arbrito[0]['Eexcluido'] == 0) {
            $this->objArbrito->where(['id'=>$idLocal])->update([
                'Eexcluido' => 1,
            ]);
            session()->flash('mensagem', "O $nome foi desativado!");
            return redirect()->route('arbrito.index');
        } else {
            $this->objArbrito->where(['id'=>$idLocal])->update([
                'Eexcluido' => 0,
            ]);
            session()->flash('mensagem', "O $nome foi ativado!");
            return redirect()->route('arbrito.index');
        }
    }

}
